<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subCategory;
use App\hlv;
use App\user_cntt;

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
        $class = subCategory::where('id', $id)->get();
        //SELECT * FROM nguoi_dung JOIN quan_ly_hoc_vien on nguoi_dung.id = quan_ly_hoc_vien.id_hoc_vien JOIN khoa_hoc on quan_ly_hoc_vien.id_khoa_hoc = khoa_hoc.id
        //SELECT * FROM nguoi_dung JOIN quan_ly_hlv on nguoi_dung.id = quan_ly_hlv.id_hlv JOIN khoa_hoc on quan_ly_hlv.id_khoa_hoc = khoa_hoc.id
        $category = \DB::table('danh_muc_khoa_hoc')->get();
        
        $bai_hoc = \DB::table('bai_hoc')
                        ->join('quan_ly_bai_hoc', 'bai_hoc.id', '=', 'quan_ly_bai_hoc.id_bai_hoc')
                        ->join('khoa_hoc', 'khoa_hoc.id', '=', 'quan_ly_bai_hoc.id_khoa_hoc')
                        ->where('khoa_hoc.id', '=', $id)
                        ->select('*')
                        ->get();
        return view('class', compact('hoc_vien', 'hlv', 'class', 'category', 'bai_hoc'));
    }
}
