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

        $student_fee = App\Models\StudentAccountFee::whereBetween('date', [$start_date, $end_date]) -> sum('amount');

        $other_cost = App\Models\AccountOtherCost::whereBetween('date', [$start_date, $end_date]) -> sum('amount');

        $employ_slry = App\Models\EmployeeAccountSalary::whereBetween('date', [$start_date, $end_date]) -> sum('amount');

        // profit calculation
        $total_cost = $other_cost + $employ_slry;
        $profit = $student_fee - $total_cost;
    @endphp


<div class="card">
    <div class="card-header">
      <?php $image_path = '/media/logo.png'; ?>
      <img src="{{ public_path() . $image_path }}" width="50">
      <h2>School ERP Management</h2>
      <p>Phone : <strong>01308663002</strong></p>
      <p>Email : <strong>info.nahian13@gmail.com</strong></p>
      <p> <strong>Total Profit</strong></p>
    </div>
    <br>
    <div class="card-body">
      
        <table id="customers">
            <tr>
                <td colspan='2' style="text-align: center; height: 20px">
                    <strong>Reporting Date : {{ date('d M Y', strtotime($start_date)) }} to {{ date('d M Y', strtotime($end_date)) }}</strong>
                </td>
            </tr>
            <tr>
              <th>Purposes</th>
              <th>Amount</th>
            </tr>
            <tr>
              <td>Student Fee</td>
              <td> <b>{{ $student_fee }}</b> </td>
            </tr>
            <tr>
              <td>Basic Salary</td>
              <td><b>{{ $employ_slry }} </b> </td>
            </tr>
            <tr>
                <td>Other Cost</td>
                <td> <b>{{ $other_cost }}</b> </td>
              </tr>
              <tr>
                <td>Total Cost</td>
                <td><b>{{ $total_cost }} </b> </td>
              </tr>
              <tr>
                <td>Total Profit</td>
                <td> <b>{{ $profit }}</b> </td>
              </tr>
            
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
 
</div>
  
  


</body>
</html>
