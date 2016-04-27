<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CartHelper;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $cart = Cart::where('selected', 1)->where('owner', Auth::user()->id)->where('status', 0);
        if($cart->count() ==0)
        {
            $cart = new Cart;
            $cart->owner = Auth::user()->id;
            $cart->selected = 1;
            $cart->created = time();
            $cart->key = md5(time().microtime(TRUE));
            $cart->status = 0;
            $items = [];
            $cart->items = json_encode($items);

            $cart->save();
        }
        $cart_items = [];

        $cart = $cart->first();
        if(!$cart)
        $cart_items = [];
        $items = [];
        $items = json_decode($cart->items, true);
        $total = 0;
        foreach($items as $item)
        {
            $product = @DB::table('shop_items')->where('id', $item['product_id'])->first();
            if(!$product)
                $this->delete($item['id']);
                else
                {
                    $datacenter = @DB::table('servers_datacenters')->where('id', $item['datacenter'])->first();
                        if(!$datacenter)
                            $this->delete();
                        else
                        {
                            $price = ($product->price*(1-($product->discount/100)))*(1+($datacenter->additional/100));
                            $cart_items[] = [
                                'id'=>$item['id'],
                                'name'=>$item['name'],
                                'description'=> substr(json_decode($product->description, true)['description'], 0, 100),
                                'price'=>number_format(round($price,2),2),
                                'datacenter' => $datacenter

                            ];
                            $total = $total+$price;
                        }

                }

        }
        if (count($cart_items) == 0) $cart_items = [];
        return view('dashboard.shop.cart', ['page' => 'shop.cart.title', 'sub' => 'shop', 'breadcrumbs' => [
                [
                    'title'=>'shop.overview',
                    'url'=>'/shop'
                ],            [
                'title' => 'shop.cart.title',
                    'url'=>'/cart'
                ],
            ],
            'cart_items'=>$cart_items,
            'total'=>number_format(round($total,2),2)
        ]);
    }


    /**
     * @return mixed
     */
    public function postAdd()
    {
        $input = Input::all();

        CartHelper::AddItemToCart(
            $input['product'],
            $input['month'],
            Auth::user()->id,
            $input['amount'],
            $input['datacenter']
        );
        return $this->success();
    }

    private function success()
    {
        Session::flash('success', 'shop.cart.items.added');
        Session::flash('head', 'shop.cart.items.added');
        return redirect(URL::to('cart'));
    }

    public function get_delete($id)
    {
        $cart = Cart::findOrFail(Cart::where('selected', 1)->where('owner', Auth::user()->id)->first()->id);
        $items = json_decode($cart->items, true);
        array_forget($items, $id-1);
        $cart->items = json_encode($items);
        $cart->save();
        Session::flash('fail', 'shop.cart.items.removed');
        return redirect(URL::to('cart'));
    }

    private function error()
    {
        Session::flash('fail', 'shop.cart.items.failed');
        return redirect(URL::to('cart'));
    }
}
