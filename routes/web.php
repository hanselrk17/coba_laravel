<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use Psy\TabCompletion\Matcher\FunctionsMatcher;

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
Route::get('/',[LoginController::class,'index'])->name('login-web.index');
Route::post('/',[LoginController::class,'login'])->name('login.index');
Route::get('/signup',[SignupController::class,'index'])->name('signup-web.index');
Route::post('/signup',[SignupController::class,'signup'])->name('signup.index');
Route::get('/logout',[LoginController::class,'logout'])->name('logout.index');
Route::get('/forgot/password',[LoginController::class,'forgotPassword'])->name('forgot_password.index');
Route::post('/forgot/password',[LoginController::class,'forgotPasswordEmail'])->name('forgot_password_send_email.index');
Route::get('/forgot/password/{id}',[LoginController::class,'forgotPasswordEnterNewPassword'])->name('forgot_password_enter_password.index');
Route::post('/forgot/password/{id}',[LoginController::class,'forgotPasswordSuccess'])->name('forgot_password_success.index');

Route::middleware('auth')->group(Function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');
    Route::get('/profile/{id}',[UserController::class,'show'])->name('show_profile.userController');
    Route::get('/profile/edit/{id}',[UserController::class,'edit'])->name('edit_profile.userController');
    Route::post('/profile/edit/{id}',[UserController::class,'update'])->name('update_profile.userController');
    Route::get('/profile/edit/password/{id}',[UserController::class,'editPassword'])->name('edit_profile_password.userController');
    Route::post('/profile/edit/password/{id}',[UserController::class,'updatePassword'])->name('update_profile_password.userController');
    Route::get('/beli-makanan/{id}',[UserController::class,'beliMakanan'])->name('beli_makanan.userController');
    
    Route::middleware('user')->group(Function(){ // khusus user tapi admin juga bisa masuk karena di middleware user admin juga di allow
        Route::group(['prefix'=>'user'],function (){
            Route::get('/buy/item',[TransactionController::class,'index'])->name('transaction_buy_item.index');
        });
    });    

    Route::middleware('admin')->group(Function(){
        Route::get('/pilih_admin',[AdminController::class,'index'])->name('admin.index');
        Route::group(['prefix'=>'pilih_admin/admin'],function (){
            Route::get('/tambah_user',[AdminController::class,'userIndex'])->name('admin_user.index');
            Route::get('/datatable_user',[AdminController::class,'dataTable'])->name('user.datatable');
            Route::get('/tambah/user',[AdminController::class,'addUserIndex'])->name('tambah_user_index.adminController');
            Route::post('/tambah/user',[AdminController::class,'addUser'])->name('tambah_user.adminController');
            Route::get('/tambah/admin',[AdminController::class,'addAdminIndex'])->name('tambah_admin_index.adminController');
            Route::post('/tambah/admin',[AdminController::class,'addAdmin'])->name('tambah_admin.adminController');
            Route::get('/delete/user/{id}',[AdminController::class,'destroy'])->name('delete_user.adminController');

            Route::get('/item',[AdminController::class,'itemIndex'])->name('admin_item.index');
            Route::get('/datatable_item',[ItemController::class,'dataTable'])->name('item.datatable');
            Route::get('/tambah/item',[ItemController::class,'addItemWeb'])->name('tambah_item_web.itemController');
            Route::post('/tambah/item',[ItemController::class,'addItem'])->name('tambah_item.itemController');
            Route::get('/edit/item/{id}',[ItemController::class,'edit'])->name('edit_item.itemController');
            Route::post('/edit/item/{id}',[ItemController::class,'update'])->name('update_item.itemController');
            Route::get('/delete/item/{id}',[ItemController::class,'destroy'])->name('delete_item.itemController');
        });
    });
});