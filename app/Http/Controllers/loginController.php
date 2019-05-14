<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\baiGiang;
use App\khoaHoc;
use App\user_cntt;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;

class loginController extends Controller
{
    //
    public function getLogin(){
        if(\Session::has('user')){
            $user = \Session::get('user')['0'];
            if(is_object($user)){
                return redirect()->route('homepage');
            }
        }
    	return view('login');
    }

    public function postLogin(Request $request){
    	$rules = [
            'email'=>'required|email',
            'password'=>'required|min:8',
    	];

    	$messsages = [
            'email.required' 		=> 'Bắt buộc phải điền email',
            'email.email' 		=> 'Email không hợp lệ',
            'password.required' 	=> 'Bắt dược phải điền password',
            'password.min' 		=> 'Password quá ngắn',
    	];

    	$validator = validator::make($request->all(), $rules, $messsages);

    	if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
    	}else{
            $email = $request->input('email');
            $password = $request->input('password');
            $nguoi_dung = user_cntt::where('email', $email)->get();
            if(count($nguoi_dung) > 0){
                if(is_object($nguoi_dung['0']) && $nguoi_dung['0']->password == $password){
                    request()->session()->put('login', true);
                    request()->session()->put('user', $nguoi_dung);
                    return redirect()->route('homepage');
                }else{
                    $errors = new MessageBag(["errorLogin" => "Email hoặc mật khẩu không chính xác"]);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            } else{
                $errors = new MessageBag(["errorLogin" => "Email hoặc mật khẩu không chính xác"]);
                return redirect()->back()->withInput()->withErrors($errors);
            }
    	};
    }
}
