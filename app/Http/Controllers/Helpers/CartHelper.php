<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cart;

class CartHelper extends Controller
{

    /**
     * @param $cart_id
     * @return array
     */
    static function returnItems($cart_id, $returnTotal = false)
    {
        $cart = Cart::where('key', $cart_id);
        if ($cart->count() == 0) {
            return [];
        }

        $details = $cart->first();

        $items = json_decode($details->items, true);
        if ($returnTotal) $total = 0;
        foreach ($items as $item) {
            $product = @DB::table('shop_items')->where('id', $item['product_id'])->first();
            $datacenter = @DB::table('servers_datacenters')->where('id', $item['datacenter'])->first();
            if ($datacenter) {
                $price = ($product->price * (1 - ($product->discount / 100))) * (1 + ($datacenter->additional / 100));
                $cart_items[] = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'description' => substr(json_decode($product->description, true)['description'], 0, 100),
                    'price' => number_format(round($price, 2), 2),
                    'datacenter' => $datacenter

                ];
                if ($returnTotal) $total = $total + $price;
            }

        }

        if ($returnTotal) return ["items" => $cart_items, "total" => number_format(round($total, 2), 2)];
        else return ["items" => $cart_items];


    }

    static function finishCart($cart)
    {
        return Cart::where('key', $cart)->update(["status" => 1]);
    }


}
