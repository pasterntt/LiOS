<?php

namespace App\Http\Controllers\Helpers;

use App\Datacenter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Product;

class ProductHelper extends Controller
{

    static function getValidatedProduct($id, $leasetime, $dc)
    {
        $product = self::getProduct($id);
        $leasetimes = json_decode($product->leasetimes);
        $month = false;

        foreach ($leasetimes as $avail_month) {
            if ($avail_month->months == $leasetime)
                $month = true;
        }
        if (!$month || !$product->active || !DatacenterHelper::getDCOffer($dc, $product->type))
            return false;
        else
            return $product;
    }

    static function getProduct($id)
    {
        return Product::findOrFail($id);
    }
}
