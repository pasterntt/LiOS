<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CartHelper;
use App\Http\Controllers\Helpers\NotificationHelper;
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
        $cart_items = CartHelper::returnItems(CartHelper::getActiveCart(Auth::user()->id, true)['key'], true)['items'];
        $total = CartHelper::returnItems(CartHelper::getActiveCart(Auth::user()->id, true)['key'], true)['total'];

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
            $input['datacenter'],
            $input['plan']
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
        CartHelper::deleteItemFromCart(CartHelper::getActiveCart(Auth::user()->id), $id);
        NotificationHelper::success("cart.item-removed", "");
        return redirect(URL::to('cart'));
    }

    private function error()
    {
        Session::flash('fail', 'shop.cart.items.failed');
        return redirect(URL::to('cart'));
    }
}
