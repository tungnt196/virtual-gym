<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subCategory;
use App\hlv;
use App\user_cntt;
use App\khoahoc;
use App\bai_giang;

class classController extends Controller
{
    //
    public function getClass($id){
        $hoc_vien = \DB::table('nguoi_dung')
                        ->join('quan_ly_hoc_vien', 'nguoi_dung.id', '=', 'quan_ly_hoc_vien.id_hoc_vien')
                        ->join('khoa_hoc', 'quan_ly_hoc_vien.id_khoa_hoc', '=', 'khoa_hoc.id')
                        ->where('khoa_hoc.id', '=', $id)
                        ->select('*')
                        ->get();
        $hlv = \DB::table('nguoi_dung')
                        ->join('quan_ly_hlv', 'nguoi_dung.id', '=', 'quan_ly_hlv.id_hlv')
                        ->join('khoa_hoc', 'quan_ly_hlv.id_khoa_hoc', '=', 'khoa_hoc.id')
                        ->where('khoa_hoc.id', '=', $id)
                        ->select('*')
                        ->get();
        $class = \DB::table('khoa_hoc')->where('id', $id)->get();
        //SELECT * FROM nguoi_dung JOIN quan_ly_hoc_vien on nguoi_dung.id = quan_ly_hoc_vien.id_hoc_vien JOIN khoa_hoc on quan_ly_hoc_vien.id_khoa_hoc = khoa_hoc.id
        //SELECT * FROM nguoi_dung JOIN quan_ly_hlv on nguoi_dung.id = quan_ly_hlv.id_hlv JOIN khoa_hoc on quan_ly_hlv.id_khoa_hoc = khoa_hoc.id
        $category = \DB::table('danh_muc_khoa_hoc')->get();
        
        $bai_hoc = \DB::table('bai_hoc')
                        ->join('khoa_hoc', 'khoa_hoc.id', '=', 'bai_hoc.khoa_hoc')
                        ->where('khoa_hoc.id', '=', $id)
                        ->select('*')
                        ->get();
        return view('class', compact('hoc_vien', 'hlv', 'class', 'category', 'bai_hoc'));
    }
    
    public function getCreateClass(){
        if(\Session::has('user')){
            $user = \Session::get('user')['0'];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
            if($user->roles == 1){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
    	return view('create_class');
    }
    
    public function postCreateClass(Request $request){
        if(!\Session::has('user')){
            return redirect()->route('homepage');
        }
        $user = \Session::get('user')['0'];
        $class = new khoahoc();
        $class->ten_khoa_hoc = $request->get('name');
        $class->mo_ta = $request->get('description');
        $class->thoi_gian_khai_giang = date('Y-m-d', strtotime($request->get('start-date')));
        $class->thoi_gian_ket_thuc = date('Y-m-d', strtotime($request->get('end-date')));
        $class->start_truc_tuyen = $request->get('start-time');
        $class->end_truc_tuyen = $request->get('end-time');
        $class->the_loai_khoa_hoc = $request->get('category');
        $file = $request->file('file');
        $file->move('assets/upload', $file->getClientOriginalName());
        $class->anh_dai_dien = '../assets/upload/'.$file->getClientOriginalName();
        $class->save();
        $hlv = new hlv();
        $hlv->id_hlv = $user->id;
        $hlv->id_khoa_hoc = $class->id;
        $hlv->save();
        $request->session()->flash('alert-success', 'Tạo lớp học thành công');
        return redirect()->route('subCategory', array($request->get('category')));
    }

    public function registerClass($idClass, $idHocVien){
        \DB::table('quan_ly_hoc_vien')->insert(
            array('id_hoc_vien' => $idHocVien, 'id_khoa_hoc' => $idClass)
        );
        return redirect()->back();
    }
    
    public function unRegisterClass($idClass, $idHocVien){
        \DB::table('quan_ly_hoc_vien')
                ->where('id_hoc_vien', '=', $idHocVien)
                ->where('id_khoa_hoc', '=', $idClass)
                ->delete();
        return redirect()->back();
    }
    
    public function getMyClass(){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        
            if($user->roles == 2){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $category = \DB::table('danh_muc_khoa_hoc')->get();
        
        $classList = \DB::table('quan_ly_hoc_vien')
                    ->join('nguoi_dung', 'quan_ly_hoc_vien.id_hoc_vien', '=', 'nguoi_dung.id')
                    ->join('khoa_hoc', 'quan_ly_hoc_vien.id_khoa_hoc', '=', 'khoa_hoc.id')
                    ->where('quan_ly_hoc_vien.id_hoc_vien', '=', $user->id)
                    ->get();
        return view('my_class', compact('classList', 'category'));
    }
    
    public function getClassManage(){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        
            if($user->roles == 1){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $category = \DB::table('danh_muc_khoa_hoc')->get();
        
        $classList = \DB::table('quan_ly_hlv')
                ->join('nguoi_dung', 'quan_ly_hlv.id_hlv', '=', 'nguoi_dung.id')
                ->join('khoa_hoc', 'quan_ly_hlv.id_khoa_hoc', '=', 'khoa_hoc.id')
                ->where('quan_ly_hlv.id_hlv', $user->id)
                ->get();
        return view('class_manage', compact('classList', 'category'));
    }
    
    public function getUploadVideo($idClass){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        
            if($user->roles == 1){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $query = \DB::table('khoa_hoc')->where('id', $idClass)->get();
        if(count($query) == 0){
            return redirect()->route('homepage');
        }
        
        $query_hlv_class = \DB::table('quan_ly_hlv')->where('id_hlv', $user->id)->where('id_khoa_hoc', $idClass)->get();
        if(count($query_hlv_class) == 0 && $user->roles != 3){
            return redirect()->route('homepage');
        }
        
        $class = $query[0];
        return view('upload_video', compact('class'));
    }
    
    public function postUploadVideo(Request $request, $idClass){
        $query = \DB::table('quan_ly_hlv')->where('id_khoa_hoc', '=', $idClass)->get();
        
        if(!count($query)){
            return redirect()->route('homepage');
        }
        
        $hlv = $query[0];
        
        if(!is_object($hlv)){
            return redirect()->route('homepage');
        }
        
        $bai_giang = new bai_giang;
        $bai_giang->ten_bai_tap = $request->get('name');
        $bai_giang->link_bai_hoc = $request->get('link-youtube-video');
        $bai_giang->nguoi_tao = $hlv->id_hlv;
        $bai_giang->khoa_hoc = $idClass;
        $bai_giang->save();
        
        $request->session()->flash('alert-success', 'Đăng bài giảng thành công');
        return redirect()->route('getViewManageLesson', array($idClass));
    }
    
    public function getUpdateClass($idClass){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $class = khoahoc::find($idClass);
        if(!count($class)){
            return redirect()->route('homepage');
        }
        
        $query_hlv_class = \DB::table('quan_ly_hlv')->where('id_hlv', $user->id)->where('id_khoa_hoc', $idClass)->get();
        if(count($query_hlv_class) == 0 && $user->roles != 3){
            return redirect()->route('homepage');
        }
        
        return view('update_class', compact('class'));
    }
    
    public function postUpdateClass(Request $request, $idClass) {
        $class = khoahoc::where('id', '=', $idClass)->firstOrFail(); //tìm model theo điều kiện của 1 trường
        $class->ten_khoa_hoc = $request->get('name');
        $class->mo_ta = $request->get('description');
        $class->thoi_gian_khai_giang = date('Y-m-d', strtotime($request->get('start-date')));
        $class->thoi_gian_ket_thuc = date('Y-m-d', strtotime($request->get('end-date')));
        $class->start_truc_tuyen = $request->get('start-time');
        $class->end_truc_tuyen = $request->get('end-time');
        $file = $request->file('file');
        if($file != null){
            $file->move('assets/upload', $file->getClientOriginalName());
            $class->anh_dai_dien = '../assets/upload/'.$file->getClientOriginalName();
        }
        $class->save();
        $request->session()->flash('alert-success', 'Cập nhật thành công');
        
        return redirect()->back();
    }
    
    public function getLesson($idClass){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $class = khoahoc::find($idClass);
        if(!count($class)){
            return redirect()->route('homepage');
        }
        
        $query_hlv_class = \DB::table('quan_ly_hlv')->where('id_hlv', $user->id)->where('id_khoa_hoc', $idClass)->get();
        if(count($query_hlv_class) == 0 && $user->roles != 3){
            return redirect()->route('homepage');
        }
        $list_lesson = bai_giang::where('khoa_hoc', $idClass)->get();
        $class = khoahoc::find($idClass);
        if(!$class){
            return redirect()->route('homepage');
        }
        
        return view('lesson_manage', compact('list_lesson', 'class'));
    }
    
    public function deleteLesson(Request $request, $idLesson){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $lesson = bai_giang::find($idLesson);
        if($lesson->nguoi_tao != $user->id  && $user->roles != 3){
            return redirect()->route('homepage');
        }
        
        \DB::table('quan_ly_bai_hoc')->where('id_bai_hoc', $idLesson)->delete();
        $lesson->delete();
        $request->session()->flash('alert-success', 'Đã xóa bài tập');
        return redirect()->back();
    }
    
    public function getUpdateLesson(){
        return redirect()->route('homepage');
    }

    public function updateLesson(Request $request, $idLesson){
        if(\Session::has('user')){
            $user = \Session::get('user')[0];
            if(!is_object($user)){
                return redirect()->route('homepage');
            }
        }else {
            return redirect()->route('homepage');
        }
        
        $class = khoahoc::where('id', '=', $idLesson)->firstOrFail();
        
        if(!count($class)){
            return redirect()->route('homepage');
        }
        
        $lesson = bai_giang::where('id','=',$idLesson)->firstOrFail();
        if($lesson->nguoi_tao != $user->id && $user->roles != 3){
            return redirect()->route('homepage');
        }
        $lesson->link_bai_hoc = $request->get('video-'.$idLesson);
        $lesson->save();
        $request->session()->flash('alert-success', 'Cập nhật thành công');
        return redirect()->back();
    }
}
