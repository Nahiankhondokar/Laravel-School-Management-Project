@php
    $prefix = Request::route() -> getPrefix();
    $route = Route::current() -> getName();
@endphp

<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
						  <h3><b>School</b> Dashboard</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		    <li class="{{ ($route == 'dashboard') ? 'active' : '' }}">
          <a href="{{ route('dashboard') }}">
            <i data-feather="pie-chart"></i>
			        <span>Dashboard</span>
          </a>
        </li>  
        @if(Auth::user() -> role == 'admin')
        <li class="treeview {{ ($prefix == '/user') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Manage User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'user.view') ? 'active' : '' }}"><a href="{{ route('user.view') }}"><i class="ti-more"></i>View User</a></li>
            <li class="{{ ($route == 'user.add') ? 'active' : '' }}"><a href="{{ route('user.add') }}"><i class="ti-more"></i>Add User</a></li>
          </ul>
        </li> 
        @endif
        <li class="treeview {{ ($prefix == '/profile') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Manage Profile</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'profile.view') ? 'active' : '' }}"><a href="{{ route('profile.view') }}"><i class="ti-more"></i>Your Profile</a></li>
            <li class="{{ ($route == 'pass.view') ? 'active' : '' }}"><a href="{{ route('pass.view') }}"><i class="ti-more"></i>Change Password</a></li>
          </ul>
        </li>

        <li class="treeview {{ ($prefix == '/setup') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Setup Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'student.class.view') ? 'active' : '' }}"><a href="{{ route('student.class.view') }}"><i class="ti-more"></i>Student Class</a></li>
            <li class="{{ ($route == 'student.year.view') ? 'active' : '' }}"><a href="{{ route('student.year.view') }}"><i class="ti-more"></i>Student Year</a></li>

            <li class="{{ ($route == 'student.group.view') ? 'active' : '' }}"><a href="{{ route('student.group.view') }}"><i class="ti-more"></i>Student Group</a></li>
            <li class="{{ ($route == 'student.shift.view') ? 'active' : '' }}"><a href="{{ route('student.shift.view') }}"><i class="ti-more"></i>Student Shift</a></li>

            <li class="{{ ($route == 'assign.subject.view') ? 'active' : '' }}"><a href="{{ route('assign.subject.view') }}"><i class="ti-more"></i>Assign Subject</a></li>
            <li class="{{ ($route == 'designation.view') ? 'active' : '' }}"><a href="{{ route('designation.view') }}"><i class="ti-more"></i>Designation</a></li>

            <li class="{{ ($route == 'fee.cat.view') ? 'active' : '' }}"><a href="{{ route('fee.cat.view') }}"><i class="ti-more"></i>Fee Category</a></li>
            <li class="{{ ($route == 'fee.amount.view') ? 'active' : '' }}"><a href="{{ route('fee.amount.view') }}"><i class="ti-more"></i>Fee Category Amount</a></li>

            <li class="{{ ($route == 'exam.type.view') ? 'active' : '' }}"><a href="{{ route('exam.type.view') }}"><i class="ti-more"></i>Exam Type</a></li>
            <li class="{{ ($route == 'subject.view') ? 'active' : '' }}"><a href="{{ route('subject.view') }}"><i class="ti-more"></i>School Subject</a></li>
            
            

          </ul>
          
        </li>

        <li class="treeview {{ ($prefix == '/students') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Student Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'student.view') ? 'active' : '' }}"><a href="{{ route('student.view') }}"><i class="ti-more"></i>Student Registration</a></li>
            <li class="{{ ($route == 'student.role.view') ? 'active' : '' }}"><a href="{{ route('student.role.view') }}"><i class="ti-more"></i>Student Roll Generate</a></li>

            <li class="{{ ($route == 'reg.fee.view') ? 'active' : '' }}"><a href="{{ route('reg.fee.view') }}"><i class="ti-more"></i>Registration Fee</a></li>
            <li class="{{ ($route == 'monthly.fee.view') ? 'active' : '' }}"><a href="{{ route('monthly.fee.view') }}"><i class="ti-more"></i>Monthly Fee</a></li>

            <li class="{{ ($route == 'exam.fee.view') ? 'active' : '' }}"><a href="{{ route('exam.fee.view') }}"><i class="ti-more"></i>Exam Fee</a></li>


          </ul>
          
        </li>
	  
        <li class="treeview {{ ($prefix == '/employee') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Employee Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'employee.reg.view') ? 'active' : '' }}"><a href="{{ route('employee.reg.view') }}"><i class="ti-more"></i>Employee Registration</a></li>

            <li class="{{ ($route == 'employee.salery.view') ? 'active' : '' }}"><a href="{{ route('employee.salery.view') }}"><i class="ti-more"></i>Employee Salery</a></li>

            <li class="{{ ($route == 'employee.leave.view') ? 'active' : '' }}"><a href="{{ route('employee.leave.view') }}"><i class="ti-more"></i>Employee Leave</a></li>
            <li class="{{ ($route == 'employee.attend.view') ? 'active' : '' }}"><a href="{{ route('employee.attend.view') }}"><i class="ti-more"></i>Employee Attendance</a></li>

            <li class="{{ ($route == 'employee.monthly.salary') ? 'active' : '' }}"><a href="{{ route('employee.monthly.salary') }}"><i class="ti-more"></i>Employee Monthly Salary</a></li>



          </ul>
          
        </li>


        <li class="treeview {{ ($prefix == '/marks') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Marks Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'student.mark.view') ? 'active' : '' }}"><a href="{{ route('student.mark.view') }}"><i class="ti-more"></i>Student Marks</a></li>
            <li class="{{ ($route == 'student.mark.edit') ? 'active' : '' }}"><a href="{{ route('student.mark.edit') }}"><i class="ti-more"></i>Student Marks Edit</a></li>

            <li class="{{ ($route == 'student.grade.view') ? 'active' : '' }}"><a href="{{ route('student.grade.view') }}"><i class="ti-more"></i>Student Grades</a></li>

          </ul>
          
        </li>


        <li class="treeview {{ ($prefix == '/account') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="mail"></i> <span>Account Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'student.fee.view') ? 'active' : '' }}"><a href="{{ route('student.fee.view') }}"><i class="ti-more"></i>Student Fee</a></li>
            <li class="{{ ($route == 'account.employee.view') ? 'active' : '' }}"><a href="{{ route('account.employee.view') }}"><i class="ti-more"></i>Employee Salary</a></li>

            <li class="{{ ($route == 'other.cost.view') ? 'active' : '' }}"><a href="{{ route('other.cost.view') }}"><i class="ti-more"></i>Other Cost</a></li>

          </ul>
          
        </li>
	  
		 
        <li class="header nav-small-cap">Report Interface</li>
		  
        <li class="treeview {{ ($prefix == '/report') ? 'active' : '' }}">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Report Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'report.profit.view') ? 'active' : '' }}"><a href="{{ route('monthly.profit.view') }}"><i class="ti-more"></i>Yearly or Monthly Profit</a></li>
            <li class="{{ ($route == 'marksheet.generate.view') ? 'active' : '' }}"><a href="{{ route('marksheet.generate.view') }}"><i class="ti-more"></i> MarkSheet Generate </a></li>

            <li class="{{ ($route == 'attend.report.view') ? 'active' : '' }}"><a href="{{ route('attend.report.view') }}"><i class="ti-more"></i> Attend Report </a></li>
            <li class="{{ ($route == 'student.result.view') ? 'active' : '' }}"><a href="{{ route('student.result.view') }}"><i class="ti-more"></i> Student Result </a></li>

            <li class="{{ ($route == 'student.idcard.view') ? 'active' : '' }}"><a href="{{ route('student.idcard.view') }}"><i class="ti-more"></i> Student ID Card  </a></li>



          </ul>
        </li>
          
        <li>
          <a href="auth_login.html">
            <i data-feather="lock"></i>
            <span>Log Out</span>
          </a>
        </li> 
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>