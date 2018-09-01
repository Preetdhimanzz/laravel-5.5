<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use Helper;
use Session;
use Redirect;
use Hash;
use File;
use Mail;
use URL;

class UserAuthController extends Controller
{
    use AuthenticatesUsers;
    public function login(Request $request)
    {
      if ($request->Ajax()) {
      $email = $request->input('email');
      $password = $request->input('password');
        if(Auth::attempt(['email' =>  $email, 'password' =>$password]))
           {
                $request->session()->regenerate();
                $response['success']         = true;
                $response['success_message'] = 'Login successfu wait we Redirecting you to Dashboard';
                $response['delayTime']       = 2000;
                // $response['url']             = URL::to(url('/withSaleCustomer'));
                return response()->json($response);
            }else{
              $response['success']         = false;
              $response['error_message'] = 'Authentication Failed Please try again';
              return response()->json($response);
            }
         }else{

           return view('auth.login');
         }
    }
}
