<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageModel;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\OTPController;

class PageController extends Controller
{
    protected $komo_api_key;
    protected $komo_endpoint;
    protected $pg_api_key;
    protected $pg_account_id;
    protected $pg_endpoint;
    protected $pg_header;
    protected $pg_bank_id;

    public function __construct(Request $req) 
    {
        $this->komo_api_key = config('api_key.komo_api_key');
        $this->komo_endpoint = config('api_key.komo_endpoint');
        $this->pg_api_key = config('api_key.pg_api_key');
        $this->pg_account_id = config('api_key.pg_account_id');
        $this->pg_endpoint = config('api_key.pg_endpoint');
        $this->pg_bank_id = config('api_key.pg_bank_id');
        $this->pg_header = 'Authorization: Bearer '.config('api_key.pg_api_key');
        
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

    public function showLoginPage() {
        return view('user/login');
    }

    public function login(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => $req->username,
            'password' => $req->password,
        ];
        $url = $this->komo_endpoint.'/v1/web-login';
        $userdata = $this->callAPI($url, null, $data);

        if ($userdata->status == 'success') {
            if ($userdata->userdata->two_fa_secret) {
                Session::forget('userdata_temp');
                Session::put('userdata_temp', $userdata->userdata);
                return view('user.otp-challenge');
            }

            Session::put('userdata', $userdata->userdata);
            return redirect('/');
        } else {
            return redirect('login')->with('error', $userdata->message);
        }
    }

    public function submitOTPChallenge(Request $req) {
        if ((new OTPController)->validateOTP(Session::get('userdata_temp')->two_fa_secret, $req->otp_input)) {
            Session::put('userdata', Session::get('userdata_temp'));
            Session::forget('userdata_temp');
            return redirect('/')->with('alert-success', 'Login Success');
        } else {
            $data = [
                'error' => 'OTP Verification Failed',
            ];
            return view('user.otp-challenge')->with($data);
        }
    }

    public function logout() {
        Session::flush();
        return redirect('login');
    }

    public function phantomLogin(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'wallet_pubkey' => $req->wallet_pubkey,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/wallet';
        $komoresponse = $this->callAPI($url, null, $data);
        if ($komoresponse) {
            if ($komoresponse->two_fa_secret) {
                Session::forget('userdata_temp');
                Session::put('userdata_temp', $komoresponse);
                return view('user.otp-challenge');
            }

            Session::put('userdata', $komoresponse);
            if ($komoresponse->wallet_pubkey || $komoresponse->semi_custodial_wallet_pubkey) {
                return redirect('/')->with('alert-success', 'Login Success');
            }
        } else {
            return redirect('register')->with('wallet_pubkey', $req->wallet_pubkey);
        }
    }

    public function refreshAccountInfo() {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/username';
        $userdata = $this->callAPI($url, null, $data);
        Session::forget('userdata');
        Session::put('userdata', $userdata);
    }

    public function showAccountDashboard() {
        if (is_null(Session::get('userdata'))) {
            return redirect('login');
        }
        $this->refreshAccountInfo();

        // Autochess History
        $postdata = [
            'api_key' => $this->komo_api_key,
            'playfab_id' => Session::get('userdata')->playfab_id,
            'limit' => 5,
        ];
        $url = $this->komo_endpoint.'/v1/match-history/list';
        $autochess = $this->callAPI($url, null, $postdata);

        // SHARD Transaction history
        $postdata = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
            'limit' => 5,
        ];
        $url = $this->komo_endpoint.'/v1/get-shard-tx-by-username';
        $shard_tx = $this->callAPI($url, null, $postdata);

        // Render data 
        $data = [
            'shard_tx' => $shard_tx,
            'autochess' => $autochess,
        ];
        return view('user/dashboard')->with($data);
    }

    public function changeDisplayName(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'playfab_id' => Session::get('userdata')->playfab_id,
            'display_name' => $req->display_name,
        ];
        $url = $this->komo_endpoint.'/v1/change-display-name';
        $result = $this->callAPI($url, null, $data);
        Session::get('userdata')->in_game_display_name = $result->display_name;
        echo "ok";
    }

    public function showTopupShardForm() {
        return view('user/topup-shard');
    }

    public function topupShardIDR(Request $req) {
        $price = (int) $req->price_idr;
        $account = Session::get('userdata')->komo_username;

        // Request Payment Gateway for QRIS
        $data = [
            'type' => 'qris',
            'amount' => $price,
        ];
        $url = $this->pg_endpoint.'/accounts/'.$this->pg_account_id.'/deposits/requests';
        $pg_data = $this->callAPI($url, $this->pg_header, $data);

        // Get QRIS URL
        $qris_url = $this->pg_endpoint.'/accounts/'.$this->pg_account_id.'/deposits/requests/'.$pg_data->id.'/qr';
                
        // Get SHARD Exchange (TBD)
        $amount_shard = $price;

        // // Save SHARD Transaction to KOMO DB
        $komo_url = $this->komo_endpoint.'/v1/save-shard-tx';
        $custom_param = [
            'QRIS' => $qris_url,
            'PG_data' => $pg_data,
        ];
        $komo_data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => $account,
            'description' => 'Topup '.$amount_shard.' SHARD via QRIS (IDR)',
            'debit_credit' => 'debit',
            'amount_shard' => $amount_shard,
            'tx_status' => 'Pending',
            'custom_param' => json_encode($custom_param),
        ];
        $komo_insert = $this->callAPI($komo_url, null, $komo_data);

        if ($komo_insert->status == "success") {
            return redirect('topup/view/qris/'.$komo_insert->komo_tx_id);
        } else {
            echo "error occured";
        }
    }

    public function topupShardIDRVA(Request $req) {
        $price = (int) $req->price_idr;
        $account = Session::get('userdata')->komo_username;

        // Request Payment Gateway for QRIS
        $data = [
            'type' => 'va',
            'amount' => $price,
            'bankId' => $this->pg_bank_id,
        ];
        $url = $this->pg_endpoint.'/accounts/'.$this->pg_account_id.'/deposits/requests';
        $pg_data = $this->callAPI($url, $this->pg_header, $data);

        // Get SHARD Exchange (TBD)
        $amount_shard = $price;

        // // Save SHARD Transaction to KOMO DB
        $komo_url = $this->komo_endpoint.'/v1/save-shard-tx';
        // $custom_param = [
        //     'PG_data' => $pg_data,
        // ];
        $komo_data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => $account,
            'description' => 'Topup '.$amount_shard.' SHARD via Virtual Account (IDR)',
            'debit_credit' => 'debit',
            'amount_shard' => $amount_shard,
            'tx_status' => 'Pending',
            'custom_param' => json_encode($pg_data),
        ];
        $komo_insert = $this->callAPI($komo_url, null, $komo_data);

        if ($komo_insert->status == "success") {
            return redirect('topup/view/va/'.$komo_insert->komo_tx_id);
        } else {
            echo "error occured";
        }
    }

    public function getQRIS(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_tx_id' => $req->tx_id,
        ];
        $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
        $returndata = $this->callAPI($komo_url, null, $data);
        $pg_data = json_decode($returndata->custom_param);
        $data = [
            'pg_data' => $pg_data,
        ];
        return view('user.show-qris')->with($data);
    }

    public function getVA(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_tx_id' => $req->tx_id,
        ];
        $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
        $returndata = $this->callAPI($komo_url, null, $data);
        $data = [
            'pg_data' => json_decode($returndata->custom_param),
        ];
        return view('user.show-va')->with($data);
    }

    public function getShardTXHistory() {
        $url = $this->komo_endpoint.'/v1/get-shard-tx-by-username';
        $postdata = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
        ];
        $shard_tx = $this->callAPI($url, null, $postdata);
        $data = [
            'shard_tx' => $shard_tx,
        ];
        return view('user/shard-tx')->with($data);
    }

    // public function checkQRISTXStatus(Request $req) {
    //     // Get TX ID from KOMO
    //     $data = [
    //         'api_key' => $this->komo_api_key,
    //         'komo_tx_id' => $req->komo_tx_id,
    //     ];
    //     $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
    //     $returndata = $this->callAPI($komo_url, null, $data);
    //     $pg_data = json_decode($returndata->custom_param);

    //     $pg_tx_id = $pg_data->PG_data->id;

    //     // Check TX From PG
    //     $url = $this->pg_endpoint.'/accounts/'.$this->pg_account_id.'/deposits/requests/'.$pg_tx_id;
    //     $pg_data = $this->callAPIGET($url, $this->pg_header);
    //     if ($pg_data->status != 'pending') {
    //         // Update KOMO Database
    //         $komo_update_url = $this->komo_endpoint.'/v1/update-shard-tx';
    //         $data = [
    //             'api_key' => $this->komo_api_key,
    //             'komo_tx_id' => $req->komo_tx_id,
    //             'tx_status' => $pg_data->status,
    //             'custom_param' => json_encode($pg_data),
    //         ];
    //         $update = $this->callAPI($komo_update_url, null, $data);
    //         if ($update == 'success') {
    //             echo $pg_data->status;
    //         }
    //     } else {
    //         echo $pg_data->status;
    //     }
    // }

    // public function checkVATXStatus(Request $req) {
    //     // Get TX ID from KOMO
    //     $data = [
    //         'api_key' => $this->komo_api_key,
    //         'komo_tx_id' => $req->komo_tx_id,
    //     ];
    //     $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
    //     $returndata = $this->callAPI($komo_url, null, $data);
    //     $pg_data = json_decode($returndata->custom_param);

    //     $pg_tx_id = $pg_data->id;

    //     // Check TX From PG
    //     $url = $this->pg_endpoint.'/accounts/'.$this->pg_account_id.'/deposits/requests/'.$pg_tx_id;
    //     $pg_data = $this->callAPIGET($url, $this->pg_header);
    //     if ($pg_data->status == 'captured') {
    //         // Update KOMO Database
    //         $komo_update_url = $this->komo_endpoint.'/v1/update-shard-tx';
    //         $data = [
    //             'api_key' => $this->komo_api_key,
    //             'komo_tx_id' => $req->komo_tx_id,
    //             'tx_status' => 'success',
    //             'custom_param' => json_encode($pg_data),
    //         ];
    //         $update = $this->callAPI($komo_update_url, null, $data);
    //         var_dump($update); exit;
    //         if ($update == 'success') {
    //             echo $pg_data->status;
    //         }
    //     } else {
    //         echo $pg_data->status;
    //     }
    // }

    public function topupShardPaypal(Request $req) {
        $price = (float) $req->price_usd;
        $account = Session::get('userdata')->komo_username;

        // Generate Paypal Payment Link
        $provider = \PayPal::setProvider();
        $provider->getAccessToken();
        $data = json_decode('{
            "intent": "CAPTURE",
            "purchase_units": [
              {
                "amount": {
                  "currency_code": "USD",
                  "value": "'.$price.'"
                }
              }
            ]
        }', true);
        $paypal = $provider->createOrder($data);

        // Get SHARD Exchange (TBD)
        $amount_shard = $price * 10000;

        // // Save SHARD Transaction to KOMO DB
        $komo_url = $this->komo_endpoint.'/v1/save-shard-tx';
        $komo_data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => $account,
            'description' => 'Topup '.$amount_shard.' SHARD via Paypal (USD)',
            'debit_credit' => 'debit',
            'amount_shard' => $amount_shard,
            'tx_status' => 'Pending',
            'custom_param' => json_encode($paypal),
        ];
        $komo_insert = $this->callAPI($komo_url, null, $komo_data);

        if ($komo_insert->status == "success") {
            return redirect($paypal['links'][1]['href']);
        } else {
            echo "error occured";
        }
    }

    function redirectPaypalLink(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_tx_id' => $req->komo_tx_id,
        ];
        $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
        $returndata = $this->callAPI($komo_url, null, $data);
        $paypal = json_decode($returndata->custom_param);
        return redirect($paypal->links[1]->href);
    }

    // function paypal() {
    //     $provider = \PayPal::setProvider();
    //     $provider->getAccessToken();
    //     $data = json_decode('{
    //         "intent": "CAPTURE",
    //         "purchase_units": [
    //           {
    //             "amount": {
    //               "currency_code": "USD",
    //               "value": "2.00"
    //             }
    //           }
    //         ]
    //     }', true);

    //     $order = $provider->createOrder($data);

    //     var_dump($order['links'][1]['href']);
    // }

    function paypalGet(Request $req) {
        // Get TX ID from KOMO
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_tx_id' => $req->komo_tx_id,
        ];
        $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
        $returndata = $this->callAPI($komo_url, null, $data);
        $pg_data = json_decode($returndata->custom_param);

        $pg_tx_id = $pg_data->id;

        // Get status from paypal
        $provider = \PayPal::setProvider();
        $provider->getAccessToken();
        $paypal = $provider->showOrderDetails($pg_tx_id);

        if ($paypal['status'] == "APPROVED") {
            // Update KOMO Database
            $komo_update_url = $this->komo_endpoint.'/v1/update-shard-tx';
            $data = [
                'api_key' => $this->komo_api_key,
                'komo_tx_id' => $req->komo_tx_id,
                'tx_status' => 'success',
                'custom_param' => json_encode($paypal),
            ];
            $update = $this->callAPI($komo_update_url, null, $data);
            if ($update) {
                echo $update;
            } else {
                echo "failed update";
            }
        } else {
            echo $paypal->status;
        }
    }

    function showRegisterPage(Request $req) {
        $data = [
            'g_recaptcha_site_key' => config('api_key.g_recaptcha_site_key'),
        ];
        if (Session::get('sso_data')) {
            $data = [
                'g_recaptcha_site_key' => config('api_key.g_recaptcha_site_key'),
                'sso_data' => Session::get('sso_data'),
            ];
        }
        return view('user.register')->with($data);
    }

    function submitRegistration(Request $req) {
        $post_data = "secret=".config('api_key.g_recaptcha_secret_key')."&response=".$req->get('g-recaptcha-response')."&remoteip=".$_SERVER['REMOTE_ADDR'] ;

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=utf-8', 'Content-Length: ' . strlen($post_data)));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
        $googresp = curl_exec($ch);      
        $decgoogresp = json_decode($googresp);
        curl_close($ch);

        if ($decgoogresp->success == true) {
            if (isset($req->subscribe) && ($req->subscribe == 1)) {
                $subs = 1;
            } else {
                $subs = 0;
            }
            $data = [
                'api_key' => $this->komo_api_key,
                'komo_username' => $req->komo_username,
                'password' => $req->password,
                'email' => $req->email,
                'wallet_pubkey' => $req->wallet_pubkey,
                'country' => $req->country,
                'game_newsletter_subscribe' => $subs,
            ];
            $url = $this->komo_endpoint.'/v1/register';
            $response = $this->callAPI($url, null, $data);
            if ($response->status == 'success') {
                if ($req->avatar) {
                    $data = [
                        'api_key' => $this->komo_api_key,
                        'komo_username' => $req->komo_username,
                        'profile_picture_url' => $req->avatar,
                    ];
                    $url = $this->komo_endpoint.'/v1/change-pp';
                    $response = $this->callAPI($url, null, $data);
                }

                return redirect('login')->with('success', $response->message);
            } else {
                return redirect('register')->with('error', $response->message);
            }
        } else {
            return redirect('register')->with('error', 'Captcha Verification Failed: '.$decgoogresp->{'error-codes'}[0]);
        }
    }

    function registerCheckUsername(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => $req->komo_username,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/username';
        $userdata = $this->callAPI($url, null, $data);

        if ($userdata) {
            $response = [
                'message' => 'Username Exists',
            ];
        } else {
            $response = [
                'message' => 'Username Not Exists',
            ];
        }
        echo json_encode($response);
    }

    function registerCheckEmail(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'email' => $req->email,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/email';
        $userdata = $this->callAPI($url, null, $data);

        if ($userdata) {
            $response = [
                'message' => 'Email Exists',
            ];
        } else {
            $response = [
                'message' => 'Email Not Exists',
            ];
        }
        echo json_encode($response);
    }

    function registerCheckWallet(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'wallet_pubkey' => $req->wallet_pubkey,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/wallet';
        $userdata = $this->callAPI($url, null, $data);

        if ($userdata) {
            $response = [
                'message' => 'Wallet Exists',
            ];
        } else {
            $response = [
                'message' => 'Wallet Not Exists',
            ];
        }
        echo json_encode($response);
    }

    function changeProfilePicture(Request $req) {
        $file = $req->profile_picture;
        if ($file->isValid()) {
            $relativepath = '/assets/profile_pic';
            $path = base_path() . $relativepath;
            $file_name = uniqid();

            // Create thumb for images
            $images_ext  = ['jpg', 'jpeg', 'png', 'bmp', 'webp'];
            if (in_array(strtolower($file->getClientOriginalExtension()), $images_ext)) {
                $img = Image::make($file)
                            ->encode('jpeg', 80)
                            ->resize(500, 500)
                            ->save($path.'/'.$file_name.'.jpg');
                $thumbs = Image::make($file)
                            ->encode('jpeg', 60)
                            ->resize(100, 100)
                            ->save($path.'/thumbs/'.$file_name.'.jpg');

                $file_url = url('/').$relativepath.'/'.$file_name.'.jpg';

                $data = [
                    'api_key' => $this->komo_api_key,
                    'komo_username' => Session::get('userdata')->komo_username,
                    'playfab_id' => Session::get('userdata')->playfab_id,
                    'profile_picture_url' => $file_url,
                ];
                $url = $this->komo_endpoint.'/v1/change-pp';
                $response = $this->callAPI($url, null, $data);
                if ($response->status == 'success') {
                    return redirect('/');
                }
            } else {
                return redirect()->back()->with('error', 'File not supported');
            }
        } else {
            return redirect()->back()->with('error', 'File invalid');
        }
    }

    function showForgotPasswordForm() {
        return view('user.forgot-password');
    }

    function submitForgotPasswordRequest(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'find_query' => $req->find_query,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/find';
        $userdata = $this->callAPI($url, null, $data);
        $email = $userdata->email;
        $beforeat = explode('@', $email)[0];
        $afterat = explode('@', $email)[1];
        $len = strlen($beforeat);
        $dots = '';
        for ($i=3; $i < $len; $i++) { 
            $dots = $dots.'*';
        }
        $censormail = substr($beforeat, 0, 2).$dots.substr($beforeat, ($len - 1), 1).'@'.$afterat;
        $data = [
            'censormail' => $censormail,
        ];

        $mail_data = [
            'komo_username' => $userdata->komo_username,
            'hash' => $userdata->playfab_id,
        ];

        if (\Mail::send('email.reset-password', $mail_data, function ($message) use ($userdata) {
                $message->from('developer@komoverse.io', 'Komoverse');
                $message->to($userdata->email);
                $message->subject('Reset Your Password - Komoverse');
            })) {
            return view('user.forgot-password-2')->with($data);
        } else {
            echo "error";
        }
        
    }

    function showNewPasswordForm(Request $req) {
        $data = [
            'hash' => $req->hash,
        ];
        return view('user.new-password')->with($data);
    }

    function submitNewPassword(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'hash' => $req->hash,
            'new_password' => $req->new_password,
        ];
        $url = $this->komo_endpoint.'/v1/reset-password';
        $userdata = $this->callAPI($url, null, $data);

        if ($userdata->status == 'success') {
            return redirect('login')->with('success', 'Password Successfully Changed.');
        } else {
            return redirect('login')->with('error', 'Failed to Change Password.');
        }
    }

    function submitChangePassword(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
            'old_password' => $req->old_password,
            'new_password' => $req->new_password,
        ];
        $url = $this->komo_endpoint.'/v1/change-password';
        $userdata = $this->callAPI($url, null, $data);

        if ($userdata->status == 'success') {
            Session::flush();
            return redirect('login')->with('success', $userdata->message);
        } else {
            return redirect()->back()->with('error', $userdata->message);
        }
    }

    function changeGameNotification(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
            'game_newsletter_subscribe' => $req->switch_num,
        ];
        $url = $this->komo_endpoint.'/v1/change-game-notif';
        $userdata = $this->callAPI($url, null, $data);
        echo json_encode($userdata);
    }

    function showLeaderboard(Request $req) {
        if (!isset($req->type)) {
            return redirect('leaderboard/daily');
        }
        switch ($req->type) {
            case 'lifetime':
                $parameter = '';
                break;

            case 'monthly':
                if (isset($req->param)) {
                    $parameter = $req->param;
                } else {
                    $parameter = date('Y-m');
                }
                break;

            case 'weekly':
                if (isset($req->param)) {
                    $parameter = str_replace('W', '', $req->param);
                } else {
                    $parameter = date('Y-W');
                }
                break;

            case 'daily':
                if (isset($req->param)) {
                    $parameter = $req->param;
                } else {
                    $parameter = date('Y-m-d');
                }
                break;
            
            default:
                # code...
                break;
        }

        $data = [
            'type' => $req->type,
            'parameter' => $parameter,
        ];

        $url = $this->komo_endpoint.'/v1/leaderboard/get';
        $response = $this->callAPI($url, null, $data);
        $resp = [
            'type' => ucfirst($req->type),
            'parameter' => $parameter,
            'lb_data' => $response,
        ];
        return view('user.leaderboard')->with($resp);
    }

    function submitVerifyEmail(Request $req) {
        $data = [
            'komo_username' => Session::get('userdata')->komo_username,
            'email' => Session::get('userdata')->email,
            'verify_code' => strtolower($req->verify_code),
            'api_key' => $this->komo_api_key,
        ];

        $url = $this->komo_endpoint.'/v1/verify-email';
        $response = $this->callAPI($url, null, $data);
        if ($response->status == 'success') {
            return redirect('/')->with('success', 'Email Verified');
        } else {
            return redirect('/')->with('error', 'Failed To Verify Email');
        }
    }

    function resendVerifyEmail() {
        $userdata = [
            'komo_username' => Session::get('userdata')->komo_username,
            'email' => Session::get('userdata')->email,
            'code' => strtoupper(substr(Session::get('userdata')->salt, 0, 6)),
        ];

        if (\Mail::send('email.verify-email', $userdata, function ($message) use ($userdata) {
                $message->from('developer@komoverse.io', 'Komoverse');
                $message->to(Session::get('userdata')->email);
                $message->subject('Verify Your Email - Komoverse');
            })) {
            return view('user.verify-code');
        } else {
            echo "error sending email";
        }
    }

    function addSolanaWallet(Request $req) {
        // check existing wallet
        $data = [
            'api_key' => $this->komo_api_key,
            'wallet_pubkey' => $req->wallet_pubkey,
        ];
        $url = $this->komo_endpoint.'/v1/account-info/wallet';
        $response = $this->callAPI($url, null, $data);
        if ($response) {
            $data = [
                'status' => 'error',
                'message' => 'This wallet is already used',
            ];
        } else {
            // insert wallet
            $data = [
                'api_key' => $this->komo_api_key,
                'wallet_pubkey' => $req->wallet_pubkey,
                'komo_username' => Session::get('userdata')->komo_username,
            ];
            $url = $this->komo_endpoint.'/v1/add-wallet';
            $response = $this->callAPI($url, null, $data);
            if ($response->status == 'success') {
                $data = [
                    'status' => 'success',
                    'message' => 'Wallet Successfully Added',
                ];
            } else {
                $data = [
                    'status' => 'error',
                    'message' => 'Failed To Add Wallet',
                ];
            }
        }
        echo json_encode($data);
    }

    function topupShardCoinPayments(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
            'amount_shard' => $req->shard_amount,
        ];
        $url = $this->komo_endpoint.'/v1/topup-shard/sol/cp';
        $response = $this->callAPI($url, null, $data);

        $redirect = json_decode($response->cp_data)->result->checkout_url;
        return redirect($redirect);
    }

    function redirectCoinPaymentsLink(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'komo_tx_id' => $req->komo_tx_id,
        ];
        $komo_url = $this->komo_endpoint.'/v1/get-shard-tx';
        $returndata = $this->callAPI($komo_url, null, $data);
        $cp_data = json_decode($returndata->custom_param);
        $redirect = $cp_data->result->checkout_url;
        return redirect($redirect);
    }

    function showMatchHistory() {
        $data = [
            'api_key' => $this->komo_api_key,
            'playfab_id' => Session::get('userdata')->playfab_id,
            'limit' => 50,
        ];
        $komo_url = $this->komo_endpoint.'/v1/match-history/list';
        $returndata = [
            'autochess' => $this->callAPI($komo_url, null, $data),
        ];
        return view('user.match-history')->with($returndata);
    }

    function showMatchDetail(Request $req) {
        $data = [
            'api_key' => $this->komo_api_key,
            'match_id' => $req->match_id,
        ];

        $komo_url = $this->komo_endpoint.'/v1/match-history/detail';
        $returndata = [
            'match_id' => $req->match_id,
            'autochess' => $this->callAPI($komo_url, null, $data),
        ];
        return view('user.match-detail')->with($returndata);
    }

    function showWithdrawPage() {
        $postdata = [
            'api_key' => $this->komo_api_key,
            'komo_username' => Session::get('userdata')->komo_username,
        ];
        $komo_url = $this->komo_endpoint.'/v1/withdraw-restrict';
        $restriction = $this->callAPI($komo_url, null, $postdata);

        $data = [
            'restriction' => $restriction,
        ];
        return view('user.withdraw-shard')->with($data);
    }
}
