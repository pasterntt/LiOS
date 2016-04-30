<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\Http\Controllers\Helpers\ProductHelper;

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

    /**
     * @param $cart
     * @return mixed
     */
    static function finishCart($cart)
    {
        return Cart::where('key', $cart)->update(["status" => 1]);
    }

    static function AddItemToCart($item, $leasetime, $user, $amount, $dc)
    {
        $cart = self::getActiveCartOrCreateOne($user, true);
        $items = $cart->items;

        $product = ProductHelper::getValidatedProduct($item, $leasetime, $dc);
        $decoded = [];
        $decoded = json_decode($items, true);
        for ($i = 1; $i <= $amount; $i++) {
            $decoded[] = [
                'product_id' => $product->id,
                'name' => $product->title,
                'runtime' => $leasetime,
                'datacenter' => $dc
            ];


        }
        $cart->items = json_encode($decoded);
        $cart->save();
        return $cart->save();
    }

    static function getActiveCartOrCreateOne($user, $details = false)
    {
        if (self::getActiveCart($user, $details)) return self::getActiveCart($user, $details);
        else return self::createCart($user);
    }

    /**
     * @param $user
     * @return bool | int
     */
    static function getActiveCart($user, $details = false)
    {
        $cart = Cart::where('owner', $user)->where('status', 0)->first();
        if (!$cart)
            return false;
        if ($details)
            return $cart;
        return $cart->id;
    }

    static function createCart($user)
    {
        $cart = new Cart;
        $cart->owner = Auth::user()->id;
        $cart->selected = 1;
        $cart->created = time();
        $cart->key = md5(time() . microtime(TRUE));
        $cart->status = 0;
        $cart->save();

        return $cart;
    }

    static function deleteItemFromCart($cart, $item_id)
    {
        $cart = self::getCart($cart);
        $items = json_decode($cart->items, true);
        array_forget($items, $item_id);
        $cart->items = json_encode(array_values($items));
        $cart->save();
        return $items;
        return 1;

    }

    static function getCart($id)
    {
        return Cart::findOrFail($id);
    }
}
