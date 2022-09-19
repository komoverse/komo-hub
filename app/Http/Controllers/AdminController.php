<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageModel;
use Session;

class AdminController extends Controller
{
    protected $komo_api_key;
    protected $komo_endpoint;

    public function __construct(Request $req) 
    {
        $this->komo_api_key = config('api_key.komo_api_key');
        $this->komo_endpoint = config('api_key.komo_endpoint');
    }

    function callAPI($url, $header, $data) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $send_header = array('Content-Type: application/json');
        if (isset($header)) {
            array_push($send_header, $header);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $send_header);

        $response = curl_exec($curl);
        var_dump($response);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }

    function callAPIGET($url, $header) {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $send_header = array('Content-Type: application/json');
        if (isset($header)) {
            array_push($send_header, $header);
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $send_header);

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response);
        return $result;
    }

    function showAdminRegisterPage() {
        return view('admin.register');
    }

    function adminRegister(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'username' => $req->username,
            'fullname' => $req->fullname,
            'password' => $req->password,
        ];
        $url = $this->komo_endpoint.'/v1/admin/register';
        $response = $this->callAPI($url, null, $data);
        var_dump($response);
    }

    function showAdminLoginPage() {
        return view('admin.login');
    }

    function loginAdmin(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'username' => $req->username,
            'password' => $req->password,
        ];
        $url = $this->komo_endpoint.'/v1/admin/login';
        $userdata = $this->callAPI($url, null, $data);
        if ($userdata->status == 'success') {
            Session::put('userdata', $userdata);
        } else {
            return redirect()->back()->with('error', $userdata->message);
        }
    }

    function logoutAdmin() {
        Session::flush();
        return redirect('admin/login');
    }
}