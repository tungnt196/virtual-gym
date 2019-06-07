<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;
use App\subCategory;

class categoryController extends Controller
{
    //
    public function getCategory(){
        $category = \DB::table('danh_muc_khoa_hoc')
                        ->join('khoa_hoc', 'danh_muc_khoa_hoc.id', '=', 'khoa_hoc.the_loai_khoa_hoc')
                        ->select('danh_muc_khoa_hoc.id', 'danh_muc_khoa_hoc.ten_danh_muc', 'danh_muc_khoa_hoc.anh_dai_dien', 'danh_muc_khoa_hoc.mo_ta', \DB::raw("COUNT(khoa_hoc.the_loai_khoa_hoc) AS number"))
                        ->groupBy('khoa_hoc.the_loai_khoa_hoc', 'danh_muc_khoa_hoc.id')
                        ->get();
    	return view('category', compact('category'));
    }
}
