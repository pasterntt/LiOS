<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $shop_items = DB::table('shop_items')->where('active', 1)->paginate(16);
        return view('dashboard.shop.index', ['page'=>'shop.overview', 'sub'=>'shop', 'breadcrumbs'=>[
            [
                'title'=>'shop.overview',
                'url'=>'/shop'
            ],
        ], 'shop_items'=>$shop_items
        ]);
    }

    public function getInsert()
    {
        DB::table('shop_items')->insert([
            'active'=>0,
            'title'=>'HP DL360 G5',
            'type'=>'root',
            'description'=>json_encode([
                'description'=>'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores ',
                'details'=>[
                    [
                        'name'=>'CPU',
                        'value'=>'2x Intel Xeon L5410'
                    ],
                    [
                        'name'=>'Cores',
                        'value'=> '2x 4',
                    ],
                    [
                        'name'=>'Threads',
                        'value'=> '2x 4',
                    ],
                    [
                        'name'=>'RAM',
                        'value'=> '4x 4GB DDR2 ECC',
                    ],
                    [
                        'name'=>'RAID-Card',
                        'value'=> 'HP P400i',
                    ],
                    [
                        'name'=>'HDD',
                        'value'=> '1x 146GB SAS 10k',
                    ],
                    [
                        'name'=>'RAID',
                        'value'=> '0',
                    ],
                    [
                        'name'=>'PSU',
                        'value'=> '2x 700W',
                    ],
                    [
                        'name'=>'Uplink',
                        'value'=> '2x 1Gbit/s',
                    ],
                    [
                        'name'=>'Downlink',
                        'value'=> '2x 1Gbit/s',
                    ],
                    [
                        'name'=>'Management',
                        'value'=> 'iLO 2',
                    ],
                ]
            ]),
            'stock'=>0,
            'sold'=>0,
            'price'=>149.99,
            'image'=> 'https://www.servershop24.de/images/produkte/i10/105385-100011-dl360-g5-1-0.jpg',
            'leasetimes'=> json_encode([
                [
                    'months'=>1,
                    'discount'=>0
                ]
            ])

        ]);

        DB::table('servers_datacenters')->insert([
            'active'=>1,
            'name'=> 'FirstColo',
            'city'=>'Frankfurt am Main',
            'country'=>'Germany',
            'root'=>1,
            'vps'=>1,
            'webspace'=>1,
            'game'=>1
        ]);
    }

    public function getProduct($id = '')
    {
        if(empty($id)) abort(404);

        if(DB::table('shop_items')->where('id', $id)->count() ==1){
            $product = DB::table('shop_items')->where('id', $id)->first();
            return view('dashboard.shop.product', ['page'=>$product->title, 'sub'=>'shop', 'breadcrumbs'=>[
                [
                    'title'=>'shop.overview',
                    'url'=>'/shop'
                ],
                [
                    'title'=>$product->title,
                    'url'=> 'shop/product/'.$id
                ]
            ], 'product'=>$product
            ]);
        }else{
            abort(404);
        }

    }
    
}
