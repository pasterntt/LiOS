<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\SolusVM;


class AjaxController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMarkRead()
    {
        $user = Auth::user()->id;
        DB::table('notifications')->where('user', $user)->update(['read'=>1]);
    }

    public function getVirtual($action, $id='')
    {
        if($action == 'status')
        {
            return SolusVM::status($id);
        }
    }

}
