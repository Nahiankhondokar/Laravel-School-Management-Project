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
              <th>Employee Atttendance Details</th>
              <th>Attendance Status</th>
            </tr>

            <tr>
              <td>{{ $allData['0'] -> Student -> name }} - {{ $allData['0'] -> Student -> id_no }}</td>
              <td>{{ date('M-Y', strtotime($month)) }}</td>
            </tr>

           @foreach($allData as $item)

           <tr>
            <td>{{ date('d-m-Y', strtotime($item -> date)) }}</td>
            <td>{{ $item -> atten_status }}</td>
          </tr>

           @endforeach

          <tr>
            <td>Total Absent : <strong>{{ $absent }}</strong>  Total Absent : <strong>{{ $leave }}</strong> </td>
            <td></td>
          </tr>
            
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
    <hr >
</div>
  
  


</body>
</html>
