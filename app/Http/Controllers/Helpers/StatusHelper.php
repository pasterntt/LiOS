<?php

namespace App\Http\Controllers\Helpers;

use App\Datacenter;
use App\Status;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Product;
use App\Services;
use App\Http\Controllers\Helpers\CartHelper;

class StatusHelper extends Controller
{

    static function returnStatus($id)
    {
        $status = Status::where("id", $id)->first();
        return $status;
    }

}
