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
     * @param $duedate
     * @param $contact
     * @param $creation
     * @param bool $copy
     * @return bool
     */
    static function createInvoice($items, $client, $duedate, $contact, $creation, $copy = true)
    {
        $contact = Contact::where('read_id', $contact)->where('owner', $client)->first();
        if (!$contact) return false;
        
    }


}
