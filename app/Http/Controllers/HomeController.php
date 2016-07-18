<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;
use Curl;
class HomeController extends Controller
{
    //
    public function index()
    {
        $client_id = env('YOUZAN_APP_ID');
        $client_secret = env('YOUZAN_APP_SECRET');
        $redirect_uri = env('YOUZAN_APP_REDIRECT_URI');
        $data = [
            'client_id'=>$client_id,
            'response_type'=>$code,
            'state'=>'auth',
            'redirect_uri'=>$redirect_uri,
            //'scope'=>''
        ];
        $url = 'https://open.koudaitong.com/oauth/authorize?'.http_build_query($data);
        return redirect($url);
    }
    public function callback(Request $request)
    {
        $code = $request->input('code');
        $url = 'https://open.koudaitong.com/oauth/token';
        $client_id = env('YOUZAN_APP_ID');
        $client_secret = env('YOUZAN_APP_SECRET');
        $redirect_uri = env('YOUZAN_APP_REDIRECT_URI');
        $data = [
            'client_id'=>$client_id,
            'client_secret'=>$client_secret,
            'grant_type'=>'authorization_code',
            'code'=>$code,
            'redirect_uri'=>$redirect_uri,
        ];
        $response = Curl::to($url)
            ->withData( $data )
            ->post();
        return $response;
    }
}
