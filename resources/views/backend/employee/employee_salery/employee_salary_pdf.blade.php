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
</style>
</head>
<body>


    @php
        $attend_data = App\Models\EmployeeAttendance::where('employee_id', $details['0']-> employee_id) -> where('atten_status', 'Absent') -> get();

        // total salary after absent cutting
        $totalAbsent = count($attend_data);
        $perDaySalary = $details['0']['Student']['salary']/30;
        $reduceSalary = $perDaySalary * $totalAbsent;
        $totalSalary = $details['0']['Student']['salary'] - $reduceSalary;

    @endphp


<div class="card">
    <div class="card-header">
      <?php $image_path = '/media/logo.png'; ?>
      <img src="{{ public_path() . $image_path }}" width="50">
      <h2>School ERP Management</h2>
      <p>Phone : <strong>01308663002</strong></p>
      <p>Email : <strong>info.nahian13@gmail.com</strong></p>
    </div>
    <br>
    <div class="card-body">
      
        <table id="customers">
            <tr>
              <th>SL</th>
              <th>Student Details</th>
              <th>Student Data</th>
            </tr>
            <tr>
              <td>1</td>
              <td>Employee Name</td>
              <td>{{ $details['0'] -> Student -> name }}</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Basic Salary</td>
              <td>{{ $details['0'] -> Student -> salary }}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Total Absent for this Month</td>
              <td>{{ $totalAbsent }}</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Reduce Salary for Absent</td>
                <td>{{ round($reduceSalary)  }}</td>
              </tr>
            <tr>
              <td>4</td>
              <td>Month</td>
              <td>{{  date('M Y', strtotime($details['0'] -> date)) }}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Salaery This Month</td>
              <td>{{ round($totalSalary) }}</td>
            </tr>
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
    <hr >
    <br>
    <table id="customers">
        <tr>
          <th>SL</th>
          <th>Student Details</th>
          <th>Student Data</th>
        </tr>
        <tr>
          <td>1</td>
          <td>Employee Name</td>
          <td>{{ $details['0'] -> Student -> name }}</td>
        </tr>
        <tr>
          <td>2</td>
          <td>Basic Salary</td>
          <td>{{ $details['0'] -> Student -> salary }}</td>
        </tr>
        <tr>
          <td>3</td>
          <td>Total Absent for this Month</td>
          <td>{{ $totalAbsent }}</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Reduce Salary for Absent</td>
            <td>{{ round($reduceSalary)  }}</td>
          </tr>
        <tr>
          <td>4</td>
          <td>Month</td>
          <td>{{  date('M Y', strtotime($details['0'] -> date)) }}</td>
        </tr>
        <tr>
          <td>7</td>
          <td>Salaery This Month</td>
          <td>{{ round($totalSalary) }}</td>
        </tr>
    </table>
    <br>
    <i>Print Date : {{ date('Y-M-d') }}</i>
</div>
  
  


</body>
</html>
