<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VirtualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        $servers = DB::table('vps')->where('owner', Auth::user()->id)->get();
        return view('dashboard.virtual.index', ['page'=>'virtual.overview', 'sub'=>'virtual', 'breadcrumbs'=>[
            [
                'title'=>'virtual.overview',
                'url'=>'/virtual'
            ],
        ], 'servers'=>$servers
        ]);
    }

    public function getVPSStatus($id)
    {
        $vps_id = DB::table('vps')->where('owner', Auth::user()->id)->where('id', $id)->first()->container_id;

        return var_dump(SolusVM::status($vps_id));

    }
}