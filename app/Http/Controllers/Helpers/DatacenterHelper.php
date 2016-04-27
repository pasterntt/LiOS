<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Product;
use App\Datacenter;
use Symfony\Component\VarDumper\Cloner\Data;

class DatacenterHelper extends Controller
{
    static function getDCOffer($dc, $feature)
    {
        $datacenter = Datacenter::findOrFail($dc);
        return $datacenter->$feature;
    }
}
