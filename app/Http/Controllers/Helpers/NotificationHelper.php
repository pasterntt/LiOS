<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NotificationHelper extends Controller
{


    static function Notify($user, $message, $type, $url = "")
    {
        DB::table('notifications')->insert([
            'content' => $message,
            'time' => time(),
            'type' => $type,
            'user' => $user,
            'url' => $url
        ]);
    }


}
