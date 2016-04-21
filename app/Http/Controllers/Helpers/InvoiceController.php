<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Contact;

class InvoiceController extends Controller
{

    /**
     * @param $items
     * @param $client
     * @param $duetime
     * @param $contact
     * @return bool
     */
    static function createInvoice($items, $client, $duetime, $contact)
    {
        $contact = Contact::where('read_id', $contact)->where('owner', $client)->first();
        if (!$contact) return false;
        
    }


}
