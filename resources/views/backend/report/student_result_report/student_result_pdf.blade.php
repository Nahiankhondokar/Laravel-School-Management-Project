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


<div class="card" style="width: 500px; margin: auto;">
    <div class="card-header">
      {{-- <?php $image_path = '/media/logo.png'; ?>
      <img src="{{ public_path() . $image_path }}" style="width: 50px; text-align:center;"> --}}
      <h2>School ERP Management</h2>
      <p>Phone : <strong>01308663002</strong></p>
      <p>Email : <strong>info.nahian13@gmail.com</strong></p>
      <p><strong>Student Result Report</strong></p>
    </div>
    <br>
    <div class="card-body">
      
        <table id="customers">
            <p> <strong>Result of </strong> {{ $allData['0'] -> Exam -> name }}</p>
            <tr>
              <th>Year / Session : {{ $allData['0'] -> StudentYear -> name }}</th>
              <th> {{ $allData['0'] -> StudentClass -> name }}</th>
            </tr>            
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
    <hr >
</div>
  
  


</body>
</html>
