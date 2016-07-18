<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helpers\Kdt;
use Session;
class HomeController extends Controller
{
    //
    public function index()
    {
        $appId = '2d359302cfd128410d';
        $appSecret = 'c11df3f0adc4139668c8ae52daaa9dcb';
        $client = new Kdt\KdtRedirectApiClient($appId, $appSecret);

        $client->redirect('http://open.himywb.com/callback', 'snsapi_base');
    }
    public function callback(Request $request)
    {
        $data = $request->all();
        Session::set('kdt', $data);
        //var_dump($data);
        return $data;
    }
}
