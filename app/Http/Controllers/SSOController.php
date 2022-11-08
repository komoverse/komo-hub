<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Session;

class SSOController extends Controller
{
    protected $komo_api_key;
    protected $komo_endpoint;


    public function __construct(Request $req) 
    {
        $this->komo_api_key = config('api_key.komo_api_key');
        $this->komo_endpoint = config('api_key.komo_endpoint');
    }


    public function komoAPIV2($method, $url, $data) {
        if ($method == 'POST') {
            $curl = curl_init($this->komo_endpoint.$url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $send_header = array('Content-Type: application/json', 'X-Api-Key: '.$this->komo_api_key);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $send_header);

            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
            return $result;
        } else if ($method == 'GET') {
            $getdata = '';
            foreach ($data as $key => $value) {
                if ($getdata != '') {
                    $getdata = $getdata.'&';
                }
                $getdata = $getdata.$key.'='.$value;
            }
            $combined_url = $this->komo_endpoint.$url.'?'.$getdata;
            $curl = curl_init($combined_url);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $send_header = array('Content-Type: application/json', 'X-Api-Key: '.$this->komo_api_key);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $send_header);

            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
            return $result;
        } else if ($method == 'GETBODY') {
            $combined_url = $this->komo_endpoint.$url;
            $curl = curl_init($combined_url);
            curl_setopt($curl, CURLOPT_POST, false);
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $send_header = array('Content-Type: application/json', 'X-Api-Key: '.$this->komo_api_key);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $send_header);

            $response = curl_exec($curl);
            curl_close($curl);
            $result = json_decode($response);
            return $result;
        }
    }

    function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    function handleGoogleCallback() {
        $sso_response = Socialite::driver('google')->user();
        $response = $this->komoAPIV2('POST', '/v2/sso/login', $sso_response);
        if ($response->status == 'success') {
            Session::put('userdata', $response->userdata);
            return redirect('/');
        } else {
            return redirect('login')->with('error', $response->message);
        }
    }

    function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    function handleFacebookCallback() {
        $sso_response = Socialite::driver('facebook')->user();
        $response = $this->komoAPIV2('POST', '/v2/sso/login', $sso_response);
        if ($response->status == 'success') {
            Session::put('userdata', $response->userdata);
            return redirect('/');
        } else {
            return redirect('login')->with('error', $response->message);
        }
    }

    function redirectToTwitter() {
        return Socialite::driver('twitter')->redirect();
    }

    function handleTwitterCallback() {
        $sso_response = Socialite::driver('twitter')->user();
        $response = $this->komoAPIV2('POST', '/v2/sso/login', $sso_response);
        if ($response->status == 'success') {
            Session::put('userdata', $response->userdata);
            return redirect('/');
        } else {
            return redirect('login')->with('error', $response->message);
        }
    }
}
