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
use App\Services;
use App\Http\Controllers\Helpers\CartHelper;

class ServiceHelper extends Controller
{

    static function bookCartAsServices($cart, $owner)
    {
        $items = CartHelper::returnItems($cart)["items"];
        foreach ($items as $item) {
            self::createService($item['name'], $item['plan'], $item['datacenter']->id, $owner);
        }
        return $items;
    }

    static function createService($name, $plan, $dc, $owner)
    {
        $service = new Services();

        $service->owner = $owner;
        $service->status = 0;
        $service->name = $name;
        $service->plan = $plan;
        $service->datacenter = $dc;

        return $service->save();
    }

    static function getServicesByUser($user)
    {
        $items = Services::where('owner', $user)->get();

        return $items;
    }

}
