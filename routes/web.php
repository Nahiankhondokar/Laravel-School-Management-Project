<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\Account\EmployeeAccountController;
use App\Http\Controllers\Backend\Account\OtherCostController;
use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\Backend\Employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\ProfileController;

use App\Http\Controllers\Backend\Setup\AssignSubjectControlller;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\ExamTypeController;
use App\Http\Controllers\Backend\Setup\FeeAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\SchoolSubjectController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentYearController;

use App\Http\Controllers\Backend\Student\ExamFeeControlller;
use App\Http\Controllers\Backend\Student\MonthlyFeeControlller;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use App\Http\Controllers\Backend\Student\StudentRegisterController;
use App\Http\Controllers\Backend\Student\StudentRoleController;

use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSaleryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Student\StudentGradeController;
use App\Http\Controllers\Backend\Student\StudentMarksController;

use App\Http\Controllers\Backend\Account\StudentFeeController;
use App\Http\Controllers\Backend\Report\AttendReportController;
use App\Http\Controllers\Backend\Report\MarkSheetController;
use App\Http\Controllers\Backend\Report\ProfitController;
use App\Http\Controllers\Backend\Report\ResultReportController;
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

Route::group(['middleware' => 'prevent-back-history'],function(){

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


// auth middleware for can not access any route without login
Route::group(['middleware' => 'auth'], function(){

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
        
        Route::post('/student/fee-category-amount/update/{fee_category_id}', [FeeAmountController::class, "FeeAmountUpdate"]) -> name('fee.amount.update');  

        Route::get('/student/fee-category-amount/details/{fee_category_id}', [FeeAmountController::class, "FeeAmountDetails"]) -> name('fee.amount.details'); 

        Route::get('/student/fee-category-amount/delete/{fee_category_id}', [FeeAmountController::class, "FeeAmountDelete"]) -> name('fee.amount.delete');


        
        // exam type rouets
        Route::get('/student/exam-type/view', [ExamTypeController::class, "ExamTypeView"]) -> name('exam.type.view'); 
        Route::get('/student/exam-type/add', [ExamTypeController::class, "ExamTypeAdd"]) -> name('exam.type.add');  

        Route::post('/student/exam-type/store', [ExamTypeController::class, "ExamTypeStore"]) -> name('exam.type.store'); 
        Route::get('/student/exam-type/edit/{id}', [ExamTypeController::class, "ExamTypeEdit"]) -> name('exam.type.edit'); 
        
        Route::post('/student/exam-type/update/{id}', [ExamTypeController::class, "ExamTypeUpdate"]) -> name('exam.type.update');  
        Route::get('/student/exam-type/delete/{id}', [ExamTypeController::class, "ExamTypeDelete"]) -> name('exam.type.delete');



        // school subject rouets
        Route::get('/student/subject/view', [SchoolSubjectController::class, "SubjectView"]) -> name('subject.view'); 
        Route::get('/student/subject/add', [SchoolSubjectController::class, "SubjectAdd"]) -> name('subject.add');  

        Route::post('/student/subject/store', [SchoolSubjectController::class, "SubjectStore"]) -> name('subject.store'); 
        Route::get('/student/subject/edit/{id}', [SchoolSubjectController::class, "SubjectEdit"]) -> name('subject.edit'); 
        
        Route::post('/student/subject/update/{id}', [SchoolSubjectController::class, "SubjectUpdate"]) -> name('subject.update');  
        Route::get('/student/subject/delete/{id}', [SchoolSubjectController::class, "SubjectDelete"]) -> name('subject.delete');




        // student Assign Subject rouets
        Route::get('/assign/subject/view', [AssignSubjectControlller::class, "AssignSubjectView"]) -> name('assign.subject.view'); 

        Route::get('/assign/subject/add', [AssignSubjectControlller::class, "AssignSubjectAdd"]) -> name('assign.subject.add');  

        Route::post('/assign/subject/store', [AssignSubjectControlller::class, "AssignSubjectStore"]) -> name('assign.subject.store'); 
        Route::get('/assign/subject/edit/{class_id}', [AssignSubjectControlller::class, "AssignSubjectEdit"]) -> name('assign.subject.edit'); 
        
        Route::post('/assign/subject/update/{class_id}', [AssignSubjectControlller::class, "AssignSubjectUpdate"]) -> name('assign.subject.update');  

        Route::get('/assign/subject/details/{class_id}', [AssignSubjectControlller::class, "AssignSubjectDetails"]) -> name('assign.subject.details'); 

        Route::get('/assign/subject/delete/{class_id}', [AssignSubjectControlller::class, "AssignSubjectDelete"]) -> name('assign.subject.delete');



        // Designation all rouets
        Route::get('/student/designation/view', [DesignationController::class, "DesignationView"]) -> name('designation.view'); 
        Route::get('/student/designation/add', [DesignationController::class, "DesignationAdd"]) -> name('designation.add');  

        Route::post('/student/designation/store', [DesignationController::class, "DesignationStore"]) -> name('designation.store'); 
        Route::get('/student/designation/edit/{id}', [DesignationController::class, "DesignationEdit"]) -> name('designation.edit'); 
        
        Route::post('/student/designation/update/{id}', [DesignationController::class, "DesignationUpdate"]) -> name('designation.update');  
        Route::get('/student/designation/delete/{id}', [DesignationController::class, "DesignationDelete"]) -> name('designation.delete');


    });


    // student management all routes
    Route::group(['prefix' => 'students'], function(){
        
        // student registration routes
        Route::get('/view', [StudentRegisterController::class, "StudetnRegView"]) -> name('student.view');      
        Route::get('/registration', [StudentRegisterController::class, "StudetnRegAdd"]) -> name('student.register');   

        Route::post('/store', [StudentRegisterController::class, "StudetnRegStore"]) -> name('student.reg.store');      
        Route::get('/search/year/class/wise', [StudentRegisterController::class, "StudetntSearchYearClassWise"]) -> name('student.search');   

        Route::get('/edit/{id}', [StudentRegisterController::class, "StudentEdit"]) -> name('student.edit');      
        Route::post('/update/{student_id}', [StudentRegisterController::class, "StudentUpdate"]) -> name('student.update');     

        Route::get('/promotion/{student_id}', [StudentRegisterController::class, "StudentPromotion"]) -> name('student.promotion');      
        Route::post('/promotion/update/{student_id}', [StudentRegisterController::class, "StudentPromotionUpdate"]) -> name('student.promotion.update');  

        Route::get('/details/{student_id}', [StudentRegisterController::class, "StudentDetails"]) -> name('student.details');   


        // student role routes   
        Route::get('/roll/generate', [StudentRoleController::class, "StudetnRoleView"]) -> name('student.role.view'); 
        Route::get('/roll/getstudent', [StudentRoleController::class, "GetStudents"]) -> name('role.registered.students'); 

        Route::post('/roll/generate', [StudentRoleController::class, "StudentRollGenerate"]) -> name('student.roll.generate'); 


        // Registration Fee routes
        Route::get('/registration/fee', [RegistrationFeeController::class, "RegFeeView"]) -> name('reg.fee.view'); 
        Route::get('/registration/fee/class/data', [RegistrationFeeController::class, "RegFeeClassData"]) -> name('student.reg.fee.classWise.get'); 

        Route::get('/registration/fee/payslip', [RegistrationFeeController::class, "RegFeePayslip"]) -> name('student.registration.fee.payslip'); 

        // Monthly Fee routes
        Route::get('/monthly/fee', [MonthlyFeeControlller::class, "MonthlyFeeView"]) -> name('monthly.fee.view'); 
        Route::get('/monthly/fee/class/data', [MonthlyFeeControlller::class, "MonthlyFeeClassData"]) -> name('student.monthly.fee.classWise.get'); 

        Route::get('/monthly/fee/payslip', [MonthlyFeeControlller::class, "MonthlyFeePayslip"]) -> name('student.monthly.fee.payslip'); 


        // Exam Fee routes
        Route::get('/exam/fee', [ExamFeeControlller::class, "ExamFeeView"]) -> name('exam.fee.view'); 
        Route::get('/exam/fee/class/data', [ExamFeeControlller::class, "ExamFeeClassData"]) -> name('student.exam.fee.classWise.get'); 

        Route::get('/exam/fee/payslip', [ExamFeeControlller::class, "ExamFeePayslip"]) -> name('student.exam.fee.payslip'); 
        
    });



    // employee all routes
    Route::group(['prefix' => 'employee'], function(){

        
        // employee registration routes 
        Route::get('/registration', [EmployeeRegController::class, "EmployeeRegView"]) -> name('employee.reg.view'); 
        Route::get('/create', [EmployeeRegController::class, "EmployeeCreate"]) -> name('employee.reg.create'); 

        Route::post('/store', [EmployeeRegController::class, "EmployeeStore"]) -> name('employee.reg.store'); 
        Route::get('/edit/{id}', [EmployeeRegController::class, "EmployeeEdit"]) -> name('employee.reg.edit'); 

        Route::post('/update/{id}', [EmployeeRegController::class, "EmployeeUpdate"]) -> name('employee.reg.update'); 
        Route::get('/details/{id}', [EmployeeRegController::class, "EmployeeDetails"]) -> name('employee.reg.details'); 

        
        // employee salery routes
        Route::get('/salery/view', [EmployeeSaleryController::class, "EmployeeSaleryView"]) -> name('employee.salery.view'); 
        Route::get('/salery/increment/{id}', [EmployeeSaleryController::class, "EmployeeSaleryIncrement"]) -> name('employee.salery.increment'); 

        Route::post('/salery/increment/store/{id}', [EmployeeSaleryController::class, "EmployeeIncrementStore"]) -> name('employee.increment.store'); 
        Route::get('/salery/details/{id}', [EmployeeSaleryController::class, "EmployeeDetails"]) -> name('employee.salery.details');

 
        // employee leave routes
        Route::get('/leave/view', [EmployeeLeaveController::class, "EmployeeLeaveView"]) -> name('employee.leave.view'); 
        Route::get('/create', [EmployeeLeaveController::class, "EmployeeCreateLeave"]) -> name('employee.leave.create'); 

        Route::post('/leave/store/', [EmployeeLeaveController::class, "EmployeeLeaveStore"]) -> name('employee.leave.store'); 
        Route::get('/leave/edit/{id}', [EmployeeLeaveController::class, "EmployeeLeaveEdit"]) -> name('employee.leave.edit');
        Route::post('/leave/update/{id}', [EmployeeLeaveController::class, "EmployeeLeaveUpdate"]) -> name('employee.leave.update');

        Route::get('/leave/delete/{id}', [EmployeeLeaveController::class, "EmployeeLeaveDelete"]) -> name('employee.leave.delete');


        // employee attendance routes
        Route::get('/attend/view', [EmployeeAttendanceController::class, "EmployeeAttendView"]) -> name('employee.attend.view'); 
        Route::get('/attend/create', [EmployeeAttendanceController::class, "EmployeeAttendCreate"]) -> name('employee.attend.create'); 

        Route::post('/attend/store/', [EmployeeAttendanceController::class, "EmployeeAttendStore"]) -> name('employee.attend.store'); 

        Route::get('/attend/edit/{date}', [EmployeeAttendanceController::class, "EmployeeAttendEdit"]) -> name('employee.attend.edit');

        Route::post('/attend/update/{date}', [EmployeeAttendanceController::class, "EmployeeAttendStore"]) -> name('employee.attend.update');

        Route::get('/attend/details/{date}', [EmployeeAttendanceController::class, "EmployeeAttendDetails"]) -> name('employee.attend.details');


        
        // employee monthly salary all routes
        Route::get('/monthly/salary/view', [MonthlySalaryController::class, "MonthlySalaryView"]) -> name('employee.monthly.salary'); 
        
        Route::get('/monthly/salary/get', [MonthlySalaryController::class, "MonthlySalaryGet"]); 

        Route::get('/monthly/salary/pdf/{employee_id}', [MonthlySalaryController::class, "MonthlySalaryPayslip"]) -> name('employee.monthly.salary.pdf'); 
        
        

    });

    // Student marks all routes
    Route::group(['prefix' => 'marks'], function (){

        // stusent marks all routes
        Route::get('/student/view', [StudentMarksController::class, 'StudentMakrView']) -> name('student.mark.view');
        Route::get('/student/subject-load/{class_id}', [StudentMarksController::class, 'StudentSubjectLoad']) -> name('student.subject.load');

        Route::get('/student/getmark', [StudentMarksController::class, 'StudentGetMark']);
        Route::post('/generate', [StudentMarksController::class, 'StudentMarkGenerate']) -> name('student.mark.generate');

        Route::get('/edit', [StudentMarksController::class, 'StudentMarkEdit']) -> name('student.mark.edit');
        Route::post('/update', [StudentMarksController::class, 'StudentMarkUpdate']) -> name('student.mark.update');

        Route::get('/edit/getstudent', [StudentMarksController::class, 'MarkEditGetStudent']);



        
        // stusent grade all routes
        Route::get('/grade/view', [StudentGradeController::class, 'StudentGradeView']) -> name('student.grade.view');
        Route::get('/grade/add', [StudentGradeController::class, 'StudentGradeAdd']) -> name('student.grade.add');

        Route::post('/grade/store', [StudentGradeController::class, 'StudentGradeStore']) -> name('student.grade.store');
        Route::get('/grade/edit/{id}', [StudentGradeController::class, 'StudentGradeEdit']) -> name('student.grade.edit');

        Route::post('/grade/update/{id}', [StudentGradeController::class, 'StudentGradeUpdate']) -> name('student.grade.update');


    });

    // accoutn management all routes
    Route::group(['prefix' => 'account'], function (){

        // Student payment routes
        Route::get('/student/fee', [StudentFeeController::class, "StudentFeeView"]) -> name('student.fee.view');
        Route::get('/student/add', [StudentFeeController::class, "StudentFeeAdd"]) -> name('student.fee.add');

        Route::get('/fee/getstudent', [StudentFeeController::class, "GetStudentAccountFee"]);
        Route::post('/student/fee/payment', [StudentFeeController::class, "StudentFeePayment"]) -> name('student.account.fee');



        // employee salary all routes
        Route::get('/employee/salary', [EmployeeAccountController::class, "EmployeeAccountView"]) -> name('account.employee.view');
        Route::get('/employee/salary/add', [EmployeeAccountController::class, "EmployeeSalaryAdd"]) -> name('account.employee.add');

        Route::get('/employee/monthly/salary/get', [EmployeeAccountController::class, "MonthlySalaryGet"]);

        Route::post('/employee/monthly/salary/store', [EmployeeAccountController::class, "EmployeeAccountSalaryStore"]) -> name('employee.account.store');



        // employee salary all routes
        Route::get('/other/cost/view', [OtherCostController::class, "OtherCostView"]) -> name('other.cost.view');
        Route::get('/other/cost/add', [OtherCostController::class, "OtherCostAdd"]) -> name('other.cost.add');

        Route::post('/other/cost/add', [OtherCostController::class, "OtherCostStore"]) -> name('other.cost.store');
        Route::get('/other/cost/edit/{id}', [OtherCostController::class, "OtherCostEdit"]) -> name('other.cost.edit');

        Route::post('/other/cost/update/{id}', [OtherCostController::class, "OtherCostUpdate"]) -> name('other.cost.update');
        Route::get('/other/cost/delete/{id}', [OtherCostController::class, "OtherCostDelete"]) -> name('other.cost.delete');




    });

    // Report all routes
    Route::group(['prefix' => 'report'], function (){

        // yearly or monthly report all routes
        Route::get('/profit/view', [ProfitController::class, "MontlyProfitView"]) -> name('monthly.profit.view');

        Route::get('/profit/pdf', [ProfitController::class, "MontlyProfitPDF"]) -> name('monthly.profit.pdf');

        Route::get('/profit/date-wise/get', [ProfitController::class, "MontlyProfitByDateWise"]);


        
        // mark sheet all routes
        Route::get('/marksheet/view', [MarkSheetController::class, "MarkSheetView"]) -> name('marksheet.generate.view');
        Route::get('/marksheet/get', [MarkSheetController::class, "MarkSheetGet"]) -> name('marksheet.generate.get');


        // Attend Report all routes
        Route::get('/employee-attend/view', [AttendReportController::class, "AttendReportView"]) -> name('attend.report.view');

        Route::get('/employee-attend/get', [AttendReportController::class, "AttendReportGet"]) -> name('attend.report.get');


        // Student Result Report all routes
        Route::get('/student-result/view', [ResultReportController::class, "ResultReportView"]) -> name('student.result.view');

        Route::get('/student-result/report/get', [ResultReportController::class, "StudentResultReportGet"]) -> name('student.result.report.get');


        // Student ID Card all routes
        Route::get('/student/id-card/view', [ResultReportController::class, "StudentIdCardView"]) -> name('student.idcard.view');

        Route::get('/student/id-card/get', [ResultReportController::class, "StudentIdCardGet"]) -> name('student.idcard.get');



    });


}); // auth route end

}); // preven browser history middleware end
