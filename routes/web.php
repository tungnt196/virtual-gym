<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\baiGiang;
use App\khoaHoc;
use App\HLV;
use App\hocVien;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', ['as'=>'homepage',function(){
    return view('homepage');
}]);

Route::get('/category', 'categoryController@getCategory')->name('category');
Route::get('/c/{id}', 'subCategoryController@getSubCategory')->name('subCategory');

route::get('/login', 'loginController@getLogin')->name('login');
route::post('/login', 'loginController@postLogin');

route::get('/class/{id}', 'classController@getClass')->name('class');

route::get('/register', 'registerController@getRegister')->name('register');
route::post('/register', 'registerController@postRegister');

Route::get('logout', function(){
    request()->session()->flush();
    return redirect()->route('homepage');
})->name('logout');

Route::get('/class-hlv', function () {
    return view('class-hlv');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/chat-1', function () {
    return view('chat_1');
});

Route::get('/chat-2', function () {
    return view('chat_2');
});

#Route::get('/chuyen_huong',function(){
#	return redirect()->route('Trang_Chu');
#})->name('test');

#Route::get('/test',function(){
#	return redirect()->route('test');
#});

#Route::get('test', function(){
#	$khoaHoc = khoaHoc::find(1);
#	var_dump($khoaHoc);
#	foreach ($khoaHoc->hocVien as $key) {
#		echo $key->hoTen.'<br>';
#	}
#});
