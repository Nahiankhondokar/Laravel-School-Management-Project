<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
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
    Route::get('/student/year/view', [StudentYearController::class, "StudentView"]) -> name('student.year.view'); 
    Route::get('/student/year/add', [StudentYearController::class, "StudentYearAdd"]) -> name('student.year.add');  

    Route::post('/student/year/store', [StudentYearController::class, "StudentYearStore"]) -> name('student.year.store'); 
    Route::get('/student/year/edit/{id}', [StudentYearController::class, "StudentYearEdit"]) -> name('student.year.edit'); 
    
    Route::post('/student/year/update/{id}', [StudentYearController::class, "StudenYearUpdate"]) -> name('student.year.update');  
    Route::get('/student/year/delete/{id}', [StudentYearController::class, "StudentYearDelete"]) -> name('student.year.delete');


    // student group rouets
    Route::get('/student/group/view', [StudentGroupController::class, "StudentView"]) -> name('student.group.view'); 
    Route::get('/student/group/add', [StudentGroupController::class, "StudentGroupAdd"]) -> name('student.group.add');  

    Route::post('/student/group/store', [StudentGroupController::class, "StudentGroupStore"]) -> name('student.group.store'); 
    Route::get('/student/group/edit/{id}', [StudentGroupController::class, "StudentGroupEdit"]) -> name('student.group.edit'); 
    
    Route::post('/student/group/update/{id}', [StudentGroupController::class, "StudenGroupUpdate"]) -> name('student.group.update');  
    Route::get('/student/group/delete/{id}', [StudentGroupController::class, "StudentGroupDelete"]) -> name('student.group.delete');


    // student shift rouets
    Route::get('/student/shift/view', [StudentShiftController::class, "StudentView"]) -> name('student.shift.view'); 
    Route::get('/student/shift/add', [StudentShiftController::class, "StudentShiftAdd"]) -> name('student.shift.add');  

    Route::post('/student/shift/store', [StudentShiftController::class, "StudentShiftStore"]) -> name('student.shift.store'); 
    Route::get('/student/shift/edit/{id}', [StudentShiftController::class, "StudentShiftEdit"]) -> name('student.shift.edit'); 
    
    Route::post('/student/shift/update/{id}', [StudentShiftController::class, "StudenShiftUpdate"]) -> name('student.shift.update');  
    Route::get('/student/shift/delete/{id}', [StudentShiftController::class, "StudentShiftDelete"]) -> name('student.shift.delete');


    // student fee category rouets
    Route::get('/student/fee-category/view', [FeeCategoryController::class, "FeeCategoryView"]) -> name('fee.cat.view'); 
    Route::get('/student/fee-category/add', [FeeCategoryController::class, "FeeCategoryAdd"]) -> name('fee.cat.add');  

    Route::post('/student/fee-category/store', [FeeCategoryController::class, "FeeCategoryStore"]) -> name('fee.cat.store'); 
    Route::get('/student/fee-category/edit/{id}', [FeeCategoryController::class, "FeeCategoryEdit"]) -> name('fee.cat.edit'); 
    
    Route::post('/student/fee-category/update/{id}', [FeeCategoryController::class, "FeeCategoryUpdate"]) -> name('fee.cat.update');  
    Route::get('/student/fee-category/delete/{id}', [FeeCategoryController::class, "FeeCategoryDelete"]) -> name('fee.cat.delete');


    // student fee category amount rouets
    Route::get('/student/fee-category-amount/view', [FeeAmountController::class, "FeeAmountView"]) -> name('fee.amount.view'); 

    Route::get('/student/fee-category-amount/add', [FeeAmountController::class, "FeeAmountAdd"]) -> name('fee.amount.add');  

    Route::post('/student/fee-category-amount/store', [FeeAmountController::class, "FeeAmountStore"]) -> name('fee.amount.store'); 
    Route::get('/student/fee-category-amount/edit/{fee_category_id}', [FeeAmountController::class, "FeeAmountEdit"]) -> name('fee.amount.edit'); 
    
    // Route::post('/student/fee-category/update/{id}', [FeeCategoryController::class, "FeeCategoryUpdate"]) -> name('fee.cat.update');  
    // Route::get('/student/fee-category/delete/{id}', [FeeCategoryController::class, "FeeCategoryDelete"]) -> name('fee.cat.delete');


});

