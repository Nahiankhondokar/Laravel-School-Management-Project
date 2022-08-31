<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('backend.index');
    })->name('dashboard');
});


// admin dashboard rotue
Route::get('admin/logout', [AdminController::class, "Logout"]) -> name('admin.logout'); 

// user route
Route::group(['prefix' => 'user'], function(){
     
    Route::get('/view', [UserController::class, "UserViewPage"]) -> name('user.view');      
    Route::get('/create', [UserController::class, "UserCreatePage"]) -> name('user.add'); 
    Route::post('/create', [UserController::class, "UserStore"]) -> name('user.store'); 

    Route::get('/edit/{id}', [UserController::class, "UserEditPage"]) -> name('user.edit'); 
    Route::post('/update/{id}', [UserController::class, "UserUpdate"]) -> name('user.update'); 
    Route::get('/delete/{id}', [UserController::class, "UserDelete"]) -> name('user.delete'); 

});


