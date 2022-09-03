<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
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


// user profile route
Route::group(['prefix' => 'profile'], function(){
     
    Route::get('/view', [ProfileController::class, "ProfileViewPage"]) -> name('profile.view');      

    Route::get('/edit/{id}', [ProfileController::class, "ProfileEditPage"]) -> name('profile.edit'); 
    Route::post('/update/{id}', [ProfileController::class, "ProfileUpdate"]) -> name('profile.update'); 
    Route::get('/password-change', [ProfileController::class, "PasswordChangePage"]) -> name('pass.view'); 
    Route::post('/password-change', [ProfileController::class, "PasswordUpdate"]) -> name('pass.update'); 
});


// Student Setup management
Route::group(['prefix' => 'setup'], function(){
     
    // student class route
    Route::get('/student/class/view', [StudentClassController::class, "StudentView"]) -> name('student.class.view');      
    Route::get('/student/class/add', [StudentClassController::class, "StudentClassAdd"]) -> name('student.class.add');  

    Route::post('/student/class/store', [StudentClassController::class, "StudentClassStore"]) -> name('student.class.store');      
    Route::get('/student/class/edit/{id}', [StudentClassController::class, "StudentClassEdit"]) -> name('student.class.edit');      

    Route::post('/student/class/update/{id}', [StudentClassController::class, "StudentClassUpdate"]) -> name('student.class.update');      
    Route::get('/student/class/delete/{id}', [StudentClassController::class, "StudentClassDelete"]) -> name('student.class.delete');
    
    // student year rouets
    Route::get('/student/class/view', [StudentClassController::class, "StudentView"]) -> name('student.year.view'); 
});

