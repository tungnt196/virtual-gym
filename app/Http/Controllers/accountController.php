<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Controllers\Controller;
use App\subCategory;
use App\hlv;
use App\user_cntt;
use App\khoahoc;
use App\bai_giang;

class accountController extends Controller
{
    public function getAccount($acc_id){
        $user = user_cntt::find($acc_id);
        if(!is_object($user)){
            return redirect()->route('homepage');
        }
        if(\Session::has('user')){
            $current_user = \Session::get('user')['0'];
            if(!is_object($current_user)){
                return redirect()->route('homepage');
            }
            if($current_user->id != $user->id){
                return redirect()->route('homepage');
            }
        } else {
            return redirect()->route('homepage');
        }
        
        return view('update_account', compact('user'));
    }
    
    public function updateAccount(Request $request, $acc_id){
        $user = user_cntt::find($acc_id);
        if(!is_object($user)){
            return redirect()->route('homepage');
        }
        
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->birthday = date('Y-m-d', strtotime($request->get('birthday')));
        if($request->get('password') != null){
            $user->password = $request->get('password');
        }
        $file = $request->file('file');
        if($file != null){
            $image = Image::make($file->getRealPath());
            $image->fit(100, 100);
            $image->save('assets/upload/'. $file->getClientOriginalName());
            $user->avatar = '../assets/upload/'.$file->getClientOriginalName();
        }
        $user->address = $request->get('address');
        $user->telephone = $request->get('telephone');
        $user->save();
        $current_user = user_cntt::where('id', $acc_id)->get();
        
        $request->session()->put('user', $current_user);
        
        $request->session()->flash('alert-success', 'Cập nhật thành công');
        
        return redirect()->back();
    }
}
