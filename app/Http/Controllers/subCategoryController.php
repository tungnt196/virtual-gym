<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subCategory;
use App\category;

class subCategoryController extends Controller
{
    //
    public function getSubCategory($id){
        $subCategory = subCategory::where('the_loai_khoa_hoc', $id)->get();
        $category = category::get();
        $main_category = category::where('id', $id)->first();
    	return view('subCategory', compact('subCategory', 'category', 'main_category', 'hlv'));
    }
}
