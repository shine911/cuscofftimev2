<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;

class LoginController extends Controller
{
    function __construct()
    {

    }
    //Login get
    public function index(){
        if(Auth::check()){
            return redirect()->intended('/');
        }
        return view('login');
    }

    public function store(Request $request){
        $rules = [
            'email' => 'required | email',
            'password' => 'required | min: 1'
        ];
        $validator = Validator::make($request->all(), $rules);
        
        if($validator->fails()){
            return redirect()->back()->withErrors(['msg' => 'Mật khẩu hoặc tài khoản không được bỏ trống']);
        } else {
            $user = $request->input('email');
            $password = $request->input('password');
            $rememberMe = false;
            if($request->input('rememberMe')=='on'){
                $rememberMe = true;
            }
            if(Auth::attempt(['email' => $user, 'password' => $password], $rememberMe)){
                return redirect()->intended('/');
            } else {
                return redirect()->back()->withErrors(['msg' => 'Sai thông tin đăng nhập']);
            }
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/login');
    }
}
