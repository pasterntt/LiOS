<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CartHelper;
use App\Http\Controllers\Helpers\InvoiceController;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Cart;
use App\User;
use App\Contact;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $cart = @Cart::where('selected', 1)->where('owner', Auth::user()->id)->where('status',0)->first();
        if(!$cart)
            abort(404);
        $cart_items = [];
        $items = json_decode($cart->items, true);
        $total = 0;
        if (count($items) > 0) {
            foreach ($items as $item) {
                $product = @DB::table('shop_items')->where('id', $item['product_id'])->first();
                if (!$product)
                    $this->delete($item['id']);
                else {
                    $datacenter = @DB::table('servers_datacenters')->where('id', $item['datacenter'])->first();
                    if (!$datacenter)
                        $this->delete();
                    else {
                        $price = ($product->price * (1 - ($product->discount / 100))) * (1 + ($datacenter->additional / 100));
                        $cart_items[] = [
                            'name' => $item['name'],
                            'description' => substr(json_decode($product->description, true)['description'], 0, 100),
                            'price' => number_format(round($price, 2), 2),
                            'datacenter' => $datacenter

                        ];
                        $total = $total + $price;
                    }

                }

            }
        }
        return view('dashboard.checkout.step1',['page'=>'checkout.step1', 'sub'=>'shop', 'breadcrumbs'=>[
            [
                'title'=>'shop.overview',
                'url'=>'/shop'
            ]
        ],
            'cart_items'=>$cart_items,
            'cart'=>$cart,
            'total'=>number_format(round($total,2),2),
        ]);
    }

    public function postDo() {

        $data = $_POST;

        if ($data["chooseContact"] == 0)
        {
            $user = new Contact;

            $user->first = $data['orderFirstname'];
            $user->last = $data['orderLastname'];
            $user->street = Crypt::encrypt($data['orderStreet']);
            $user->number = Crypt::encrypt($data['orderStreetnumber']);
            $user->zip = Crypt::encrypt($data['orderZIP']);
            $user->city = Crypt::encrypt($data['orderCity']);
            $user->country = Crypt::encrypt($data['orderCountry']);
            $user->read_id = rand(0,99999);
            $user->owner = Auth::user()->id;

            $user->save();
            $contact = $user;
        } else
            $contact = $data["chooseContact"];

        CartHelper::finishCart($data['cart']);
        InvoiceController::generateFirstInvoice(CartHelper::returnItems($data["cart"], true), Auth::user()->id, time() + 14 * 24 * 60 * 60, $contact, time());
        Session::flash('success', true);
        Session::flash('heading', trans('invoice.new'));
        Session::flash('body', trans('invoice.please-pay'));

        return Redirect::to('/dashboard');

    }
}


