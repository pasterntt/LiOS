<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('dashboard.index', ['page'=>'pages.dashboard', 'breadcrumbs'=>[
            [
                'title'=>'navigation.dashboard',
                'url'=>'/dashboard'
            ]
        ]]);
    }

    public function getNotify()
    {
        DB::table('notifications')->insert([
            'content'=>'Der Server "root00001.dedicated.lio-script.de" wurde erfolgreich neugestartet.',
            'time'=>time(),
            'type'=>'success',
            'user'=>Auth::user()->id,
            'url'=>''
        ]);
    }

    
}
