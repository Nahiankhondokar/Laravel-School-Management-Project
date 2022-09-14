@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row" >
          <div class="col-12">

            <div class="box bb-3 border-warning" style="padding: 20px !important;">
           

              @php
                  $assign_student = App\Models\AssignStudent::where('year_id', $all_marks['0'] -> year_id) -> where('class_id', $all_marks['0'] -> class_id) -> first();
              @endphp
              
              <div class="text-center">
                  <h3 class="">School ERP Management</h3>
                  <p class="text-center"><strong>Dhaka, Bangladesh</strong></p>
                  <p class="text-center"><strong>Academic Transcript</strong></p>
                  <p class="text-center"><strong>{{ $all_marks['0'] -> Exam -> name }}</strong></p>
              </div>
                  <hr>
              <div class="row">
                <div class="col-md-6">
                  <table class="table text-center" style="border: 1px solid rgb(92, 92, 92)">
                    <tr>
                      <th colspan="2" class="text-center">Student Details</th>
                    </tr>
                    <tr>
                      <td>Id No</td>
                      <td>{{ $assign_student -> Student -> id_no }}</td>
                    </tr>
                    <tr>
                      <td>Roll No</td>
                      <td>{{ $assign_student -> roll }}</td>
                    </tr>
                    <tr>
                      <td>Name</td>
                      <td>{{ $assign_student -> Student -> name }}</td>
                    </tr>
                    <tr>
                      <td>Session</td>
                      <td>{{ $assign_student -> StudentYear -> name}}</td>
                    </tr>
                </table>
                </div>
                <div class="col-md-6">
                  <table class="table text-center" style="border: 1px solid rgb(92, 92, 92)">
                    <tr>
                      <th>Letter Grade</th>
                      <th>Marks Interval</th>
                      <th>Grade Points</th>
                    </tr>
                    @foreach($all_grades as $item)
                      <tr>
                        <td>{{ $item -> grade_name }}</td>
                        <td>{{ $item -> start_marks }} - {{ $item -> end_marks }}</td>
                        <td>{{ number_format((float)$item -> start_point, 2) }} - {{ number_format((float)$item -> end_point, 2) }}</td>
                      </tr>
                    @endforeach
                </table>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center">Student Subject Mark</h4>
                  <table class="table text-center" style="border: 1px solid rgb(92, 92, 92)">
                    <thead>
                      <tr>
                        <th>Subject</th>
                        <th>Get Marks</th>
                        <th>Letter Gradel</th>
                        <th>Grade Points</th>
                      </tr>
                    </thead>

                    <tbody>

                    @php
                      $total_point = 0;
                      $total_mark = 0;
                    @endphp

                    @foreach($all_marks as $key => $item)
                      
                      @php
                      $get_mark = $item -> marks;
                      $total_mark = (float)$total_mark + (float)$get_mark;
                      $total_sub = App\Models\StudentMark::where('year_id', $item -> year_id) -> where('class_id', $item -> class_id) -> where('exam_type_id', $item -> exam_type_id) -> where('id_no', $item -> id_no) -> where('student_id', $item -> student_id) -> get() -> count();

                      $get_grade = App\Models\StudentGrade::where([['start_marks', '<=', (int)$item -> marks], ['end_marks', '>=', (int)$item -> marks]]) -> first();
  
                      // dd($get_mark);
                      
                      $grade_point = number_format((float)$get_grade -> grade_point, 2);
                      $total_point = (float)$total_point + (float)$grade_point;

                      
                      // dd($total_point);

                      @endphp 

                    

                      <tr>
                        <td>{{ $item -> Subject -> name }}</td>
                        <td>{{ $get_mark }}</td>
                        <td> 
                          {{ $get_grade -> grade_name }} 
                        </td>
                        <td>
                          {{ $get_grade -> grade_point }} 
                        </td>
                      </tr>

                    @endforeach

                    <tr>
                      <td colspan="3">
                        Total Marks
                      </td>
                      <td colspan="3">
                        {{ $total_mark }} 
                      </td>
                    </tr>

                    </tbody>

                  </table>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <h4 class="text-center"></h4>
                  <table class="table text-center" style="border: 1px solid rgb(92, 92, 92)">
                    <tr>
                      <th>Avarage Point</th>
                      <th>Letter Grade</th>
                      <th>Total Marks with Fraction</th>
                    </tr>

                    @php
                    $total_grade = 0;
                    $point_for_letter_grade = (float)$total_point/(float)$total_sub;
                    $total_grade = App\Models\StudentGrade::where([['start_point', '<=', $point_for_letter_grade], ['end_point', '>=', $point_for_letter_grade]]) -> first();

                    $grade_point_avg = (float)$total_point/(float)$total_sub;
                    
                    @endphp 

                    <tr>
                      <td>
                        @if($fail_count > 0)
                          0.00
                          @else 
                          {{ number_format((float)$grade_point_avg, 2) }}</td>
                        @endif
                        
                      <td> 
                        @if($fail_count > 0)
                        F
                        @else 
                        {{ $total_grade -> grade_name }}</td>
                      @endif
                      </td>
                      <td> {{ $total_mark }}</td>
                    </tr>

                    <br>

                  </table>
                </div>
              </div>


              <div class="row">
                <div class="col-md-12">
                  <p style="border: 1px solid rgb(92, 92, 92); text-align:center;">Remark : <strong>
                    @if($fail_count > 0)
                        Fail
                        @else 
                        {{ $total_grade -> remarks }}</td>
                      @endif
                  </strong> </p>
                </div>
              </div>

              <br>
              <br>
              <i style="margin: 10px 0px;">Print Date : {{ date('Y-M-d') }}</i>
              <br>
              <br>
              
            </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

@endsection