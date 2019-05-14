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

Route::get('/old',function(){
    return view('homepage_old');
});

Route::get('/category', 'categoryController@getCategory')->name('category');
Route::get('/c/{id}', 'subCategoryController@getSubCategory')->name('subCategory');

route::get('/login', 'loginController@getLogin')->name('login');
route::post('/login', 'loginController@postLogin');

route::get('/test', function(){
    return view('test_RTC');
})->name('class');

route::get('/account/{id}', 'accountController@getAccount')->name('getAccount');
route::post('/account/{id}', 'accountController@updateAccount')->name('updateAccount');

route::get('/class/{id}', 'classController@getClass')->name('class');
route::get('/class-register/{idClass}/{idHocVien}', 'classController@registerClass')->name('registerClass');
route::get('/class-unregister/{idClass}/{idHocVien}', 'classController@unregisterClass')->name('unregisterClass');
route::get('/create-class', 'classController@getCreateClass')->name('getViewCreateClass');
route::post('/create-class', 'classController@postCreateClass')->name('createClass');
route::get('/upload-video/class-{id}', 'classController@getUploadVideo')->name('getViewUploadVideo');
route::post('/upload-video/class-{id}', 'classController@postUploadVideo')->name('uploadVideo');
route::get('/update-class/{id}', 'classController@getUpdateClass')->name('getViewUpdateClass');
route::post('/update-class/{id}', 'classController@postUpdateClass')->name('updateClass');
route::get('/manage-lesson/{id}', 'classController@getLesson')->name('getViewManageLesson');
route::get('/delete-lesson/{id}', 'classController@deleteLesson')->name('deleteLesson');
route::get('/update-lesson/{id}', 'classController@getUpdateLesson');
route::post('/update-lesson/{id}', 'classController@updateLesson')->name('updateLesson');

route::get('/register', 'registerController@getRegister')->name('register');
route::post('/register', 'registerController@postRegister');

Route::get('logout', function(){
    request()->session()->flush();
    return redirect()->route('homepage');
})->name('logout');

Route::get('/class-hlv', function () {
    return view('class-hlv');
});

Route::get('/my-class', 'classController@getMyClass')->name('myClass');

Route::get('/class-manage', 'classController@getClassManage')->name('classManage');

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
