<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

h2, p{
    margin: 0px;
    padding: 2px 0;
    text-align: center;

}


html {
  font-family:arial;
  font-size: 18px;
}

td {
  border: 1px solid #726E6D;
  padding: 15px;
}

thead{
  font-weight:bold;
  text-align:center;
  background: #625D5D;
  color:white;
}

table {
  border-collapse: collapse;
}

.footer {
  text-align:right;
  font-weight:bold;
}

tbody >tr:nth-child(odd) {
  background: #D1D0CE;
}

</style>
</head>
<body>


    @php
        $assign_student = App\Models\AssignStudent::where('year_id', $all_marks['0'] -> year_id) -> where('class_id', $all_marks['0'] -> class_id) -> first();
    @endphp

<div class="card">
    <div class="card-header">
        <img src="" width="50">
      <h2>School ERP Management</h2>
      <p><strong>{{$all_marks['0'] -> Exam -> name}}</strong></p>
      <p><strong>Student Marksheet </strong></p>
    </div>
    <br>
    <div class="card-body">
      
        <table id="customers">
            <tr>
              <th>SL</th>
              <th>Student Details</th>
            </tr>
            <tr>
                <td>01</td>
                <td>
                    Name : {{ $assign_student -> Student -> name ?? 'None' }}
                    <br>
                    Roll : {{ $assign_student -> Student -> roll ?? 'None' }}<br>
                    Session : {{ $assign_student -> Student -> session ?? 'None' }}<br>
                    Exam : {{$all_marks['0'] -> Exam -> name}}
                    Id No : {{ $assign_student -> Student -> id_no ?? 'None' }}
                </td>
            </tr>
           
        </table>

    <br>
    <table style="width: 98%; text-aign:center">
        <thead>
          <tr>
            <th >Subject </th>
            <th > Marks </th>
            <th > Letter Grade </th>
            <th > Total Grade </th>
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

    <br>

    <table class="table text-center" style="border: 1px solid rgb(92, 92, 92); width: 98%">
       <thead>
        <tr>
            <th>Avarage Point</th>
            <th>Letter Grade</th>
            <th>Total Marks with Fraction</th>
          </tr>
       </thead>

        @php
        $total_grade = 0;
        $point_for_letter_grade = (float)$total_point/(float)$total_sub;
        $total_grade = App\Models\StudentGrade::where([['start_point', '<=', $point_for_letter_grade], ['end_point', '>=', $point_for_letter_grade]]) -> first();

        $grade_point_avg = (float)$total_point/(float)$total_sub;
        
        @endphp 

       <tbody>
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
  
       </tbody>

      </table>

        <hr>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
    
</div>
  
  


</body>
</html>
