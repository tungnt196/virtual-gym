<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\baiGiang;
use App\khoaHoc;
use App\user_cntt;
use Validator;
use Auth;
use Illuminate\Support\MessageBag;

class registerController extends Controller
{
    //
    public function getRegister(){
        $user = \Session::get('user')['0'];
        if(is_object($user)){
            return redirect()->route('homepage');
        }
    	return view('register');
    }

    public function postRegister(Request $request){
//    	$rules = array(
//    		"name"=>"required",
//    		"birthday"=>"required",
//    		"email"=>"required|email",
//    		"telephone"=>"required|min:10|max:10",
//    		"address"=>"required",
//    		"password"=>"required",
//    	);
//    	$validator = Validator::make($request->all(),$rules);
//    	if(!($validator->fails())){
            $user = new user_cntt;
            $user->name=$request->input('name');
            $user->email=$request->input('email');
            $user->password=$request->input('password');
            $user->roles=$request->input('roles');
            if($request->input('roles') == 2){
                echo "Đăng ký HLV thành công";
                return redirect()->route('login');
            } else {
                echo "Đăng ký học viên thành công";
                return redirect()->route('login');
            }
            $user->save();
//    	}else{
//          echo "Lỗi";
//    	}
    }
}
