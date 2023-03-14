<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteCon;
use App\Http\Controllers\AuthenticateCon;
use App\Http\Controllers\AppCon;
use App\Http\Controllers\IncCon;
use App\Http\Controllers\DevCon;
use App\Http\Controllers\UsersCon;
use App\Http\Controllers\ModulCon;
/*USE*/

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

// Route::get('/403', function(){
//     return abort(403, 'Unauthorized action.');
// });



Route::get('/', [WebsiteCon::class,'home'])->name('home');
Route::get('/apps',[AppCon::class,'index'])->middleware('auth');
Route::post('/apps',[AppCon::class,'kunci'])->middleware('auth');

// USERS START
Route::get('/user_m_book',[UsersCon::class,'mbook'])->middleware('auth');
Route::post('/user_m_book',[UsersCon::class,'get_mbook'])->middleware('auth');
Route::get('/profil/{id}',[UsersCon::class,'profil']);
Route::get('/cetak_profil/{id}',[UsersCon::class,'cetak_profil']);
Route::get('/me_profil',[UsersCon::class,'me_profil'])->middleware('auth');
Route::post('/profil_post',[UsersCon::class,'profil_post'])->middleware('auth');
Route::post('/profil_foto',[UsersCon::class,'profil_foto'])->middleware('auth');
Route::get('/user_table/{level}', [UsersCon::class,'table'])->middleware('auth');
Route::post('/user_get/{level}', [UsersCon::class,'get'])->middleware('auth');
Route::post('/user_crop_img', [UsersCon::class,'crop_img'])->middleware('auth');
Route::post('/user_delete', [UsersCon::class,'delete'])->middleware('auth');
Route::post('/user_crud', [UsersCon::class,'crud'])->middleware('auth');
Route::post('/user_rpass', [UsersCon::class,'reset'])->middleware('auth');
Route::post('/user_rpin', [UsersCon::class,'rpin'])->middleware('auth');
Route::post('/user_ban', [UsersCon::class,'ban'])->middleware('auth');
// USERS END

// MODUL START
Route::get('/modul/{class?}',[ModulCon::class,'index'])->middleware('auth');
Route::post('/modul/{class?}',[ModulCon::class,'get_data'])->middleware('auth');
Route::post('/modul_install',[ModulCon::class,'install'])->middleware('auth');
Route::post('/modul_uninstall',[ModulCon::class,'uninstall'])->middleware('auth');
Route::post('/modul_upload',[ModulCon::class,'upload'])->middleware('auth');
Route::post('/modul_delete',[ModulCon::class,'delete'])->middleware('auth');
Route::post('/modul_cek',[ModulCon::class,'cek_modul'])->middleware('auth');
// MODUL END

// INC START
Route::get('/inc_apps', [IncCon::class,'apps'])->middleware('auth');
Route::post('/upload_logo', [IncCon::class,'upload_logo'])->name('upload_logo')->middleware('auth');
Route::get('/inc_control', [IncCon::class,'control'])->middleware('auth');
Route::post('/update_inc', [IncCon::class,'update_inc'])->name('update_inc')->middleware('auth');
Route::get('/inc_style', [IncCon::class,'style'])->middleware('auth');
Route::post('/update_color', [IncCon::class,'update_color'])->name('update_color')->middleware('auth');
Route::get('/inc_m_book', [IncCon::class,'mbook'])->middleware('auth');
Route::post('/inc_m_book', [IncCon::class,'get_mbook'])->middleware('auth');
Route::post('/inc_crud_mbook', [IncCon::class,'crud_mbook'])->middleware('auth');
Route::post('/inc_check_mbook', [IncCon::class,'check_mbook'])->middleware('auth');
// INC END

// DEVELOPE START
Route::get('/dev_input/{id}', [DevCon::class,'input'])->middleware('auth');
Route::post('/get_input/{level}/{col}', [DevCon::class,'get_input'])->name('get_input')->middleware('auth');
Route::post('/crud_input/{level}', [DevCon::class,'crud_input'])->name('crud_input')->middleware('auth');
Route::get('/dev_side/{id}', [DevCon::class,'set_side'])->middleware('auth');
Route::post('/cr_side/{level}', [DevCon::class,'cr_sidebar'])->middleware('auth');
Route::get('/dev_easyui', [DevCon::class,'easyui'])->middleware('auth');
Route::post('/dev_easyui', [DevCon::class,'upload_easyui'])->middleware('auth');
Route::get('/dev_file/{dir?}', [DevCon::class,'file'])->middleware('auth');
Route::post('/dev_file/{dir?}', [DevCon::class,'upload_zip'])->middleware('auth');
Route::post('/dev_file_dir', [DevCon::class,'file_dir'])->middleware('auth');
Route::post('/dev_file_del', [DevCon::class,'file_del'])->middleware('auth');
Route::get('/fontawesome', [DevCon::class,'fontawesome']);
Route::get('/dev_engine', [DevCon::class,'engine'])->middleware('auth');
Route::post('/get_engine', [DevCon::class,'get_engine'])->name('get_engine')->middleware('auth');
Route::post('/crud_engine', [DevCon::class,'crud_engine'])->name('crud_engine')->middleware('auth');
Route::get('/dev_sidebar', [DevCon::class,'sidebar'])->middleware('auth');
Route::post('/get_sidebar', [DevCon::class,'get_sidebar'])->name('get_sidebar')->middleware('auth');
Route::post('/sidebar_checked', [DevCon::class,'sidebar_checked'])->name('sidebar_checked')->middleware('auth');
Route::post('/crud_sidebar', [DevCon::class,'crud_sidebar'])->name('crud_sidebar')->middleware('auth');
Route::get('/dev_admin', [DevCon::class,'super_admin'])->middleware('auth');
Route::post('/dev_admin', [DevCon::class,'super_admin_post'])->name('dev_admin')->middleware('auth');
Route::post('/foto_admin', [DevCon::class,'super_admin_foto'])->name('foto_admin')->middleware('auth');
// DEVELOPE END

// AUTENTICATE START
Route::get('/login', [AuthenticateCon::class,'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthenticateCon::class,'login_authenticate'])->name('login_authenticate');
Route::post('/g_pass', [AuthenticateCon::class,'change_password_authenticate'])->name('change_password_authenticate')->middleware('auth');
Route::post('/logout', [AuthenticateCon::class,'logout']);
Route::get('/register', [AuthenticateCon::class,'register'])->middleware('guest');
Route::get('/forgot', [AuthenticateCon::class,'forgot'])->middleware('guest');
Route::post('/get_exists', [AuthenticateCon::class,'get_exists'])->middleware('auth');
Route::post('/get_dir', [AuthenticateCon::class,'get_dir'])->middleware('auth');
// AUTENTICATE END

include_once 'web_lt.php';

use App\Http\Controllers\GetAjax;
Route::get('/get_user', [GetAjax::class,'get_user'])->name('get_user');