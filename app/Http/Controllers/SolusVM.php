<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SolusVM extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    static function status($id)
    {
        $postfields = [
            'action'=>'vserver-status',
            'vserverid'=>$id
        ];

        $data = self::connectToHost($postfields);
        $response = json_decode($data, true);

        if($response['status']=='success')
            return $response;
        else
            return $data;
    }

    static function connectToHost($postfields)
    {
        $ip='88.198.254.85';
        $port='5656';
        $api_id = '';
        $api_key = '';
        $url = "https://$ip:$port/api/admin";

        $postfields['id'] = $api_id;
        $postfields['key']=$api_key;
        $postfields['key']=$api_key;
        $postfields['rdtype']='json';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . "/command.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Expect:"));
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        $data = @curl_exec($ch);
        curl_close($ch);
        if(!$data)
            return [
                'status'=>'error',
                'class'=>'error'
            ];

        return $data;
    }
}
