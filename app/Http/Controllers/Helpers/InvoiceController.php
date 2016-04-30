<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App;
use App\Http\Controllers\Helpers\NotificationHelper;
use Illuminate\Support\Facades\URL;
use App\Invoice;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Mail;

class InvoiceController extends Controller
{


    static function generateFirstInvoice($items, $client, $duedate, $contact, $creation)
    {
        $invoice = self::createInvoice($items, $client, $duedate, $contact, $creation);
        NotificationHelper::Notify($client, "notification.invoice.created", "info", URL::to('invoices'));

        $client = App\User::findOrFail($client);

        return $invoice;
    }

    /**
     * @param $items
     * @param $client
     * @param $duedate
     * @param $contact
     * @param $creation
     * @param bool $copy
     * @return bool
     */
    static function createInvoice($items, $client, $duedate, $contact, $creation)
    {
        $contact = Contact::where('read_id', $contact)->where('owner', $client)->first();
        if (!$contact) return false;

        $total = 0;

        $invoice = new Invoice;

        $invoice->created = time();
        $invoice->due = $duedate;
        $invoice->amount = $total;
        $invoice->owner = $client;
        $invoice->contact = Crypt::encrypt(json_encode($contact, 1));
        $invoice->items = Crypt::encrypt(json_encode($items, 1));

        $invoice->recurring = 1;

        $invoice->save();



        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('documents.invoice', ['client' => $contact, 'items' => $items, 'created' => $creation, "due" => $duedate, "copy" => false]);
        $file = "invoices/" . date("d-m-Y") . "/" . md5(time() . $client) . ".pdf";
        Storage::put($file, $pdf->output());

        $client = User::findOrFail($client);

        Mail::send('emails.invoice', ['user' => $client, "creation" => $creation, "duedate" => $duedate, "total" => $items["total"]], function ($m) use ($client, $file) {

            $m->to($client->email, $client->name)->subject(trans("invoice.new"));
            $m->attach(storage_path("app") . "/" . $file);

        });
        Storage::delete($file);

        return true;
    }
    

}
