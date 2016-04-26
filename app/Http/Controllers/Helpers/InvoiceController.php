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

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('documents.invoice', ['client' => $contact, 'items' => $items, 'created' => $creation, "due" => $duedate, "copy" => false]);
        return $pdf->download();
    }
    

}
