<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;

class mainController extends Controller
{
    //
    public function getMain(){
        $category = category::all();
    	return view('main', compact('category'));
    }
}
