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
        $registrationfee = App\Models\FeeCategoryAmount::where('fee_category_id','4')->where('class_id',$details->class_id)->first();


        $originalfee = $registrationfee->amount;
        $discount = $details['StudentDiscount']['discount'];
        $discounttablefee = $discount/100*$originalfee;
        $finalfee = (float)$originalfee-(float)$discounttablefee;
    @endphp


<div class="card">
    <div class="card-header">
        <?php $image_path = '/media/logo.png'; ?>
        <img src="{{ public_path() . $image_path }}" width="50">
      <h2>School ERP Management</h2>
      <p>Phone : <strong>01308663002</strong></p>
      <p>Email : <strong>info.nahian13@gmail.com</strong></p>
      <p><strong>Student Monthly Fee</strong></p>
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
              <td>Id No</td>
              <td>{{ $details -> Student -> id_no }}</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Role</td>
              <td>{{ $details -> roll}}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Name</td>
              <td>{{ $details -> Student -> name }}</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Father</td>
              <td>{{ $details -> Student -> f_name }}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Religion</td>
              <td>{{ $details -> StudentClass -> name }}</td>
            </tr>
              <td>10</td>
              <td>Year</td>
              <td>{{ $details -> StudentYear -> name }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Registration Fee</td>
                <td>{{ $originalfee }} </td>
            </tr>
            <tr>
                <td>14</td>
                <td>Discount Fee</td>
                <td>{{ $discount }} %</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Monthly Total Fee ({{ $month }})</td>
                <td>{{ $finalfee }} $</td>
            </tr>
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
    <hr >
    <br>
    <br>
    <br>
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
              <td>Id No</td>
              <td>{{ $details -> Student -> id_no }}</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Role</td>
              <td>{{ $details -> roll}}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Name</td>
              <td>{{ $details -> Student -> name }}</td>
            </tr>
            <tr>
              <td>4</td>
              <td>Father</td>
              <td>{{ $details -> Student -> f_name }}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Religion</td>
              <td>{{ $details -> StudentClass -> name }}</td>
            </tr>
              <td>10</td>
              <td>Year</td>
              <td>{{ $details -> StudentYear -> name }}</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Registration Fee</td>
                <td>{{ $originalfee }} </td>
            </tr>
            <tr>
                <td>14</td>
                <td>Discount Fee</td>
                <td>{{ $discount }} %</td>
            </tr>
            <tr>
                <td>14</td>
                <td>Monthly Total Fee ({{ $month }})</td>
                <td>{{ $finalfee }} $</td>
            </tr>
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
</div>
  
  


</body>
</html>
