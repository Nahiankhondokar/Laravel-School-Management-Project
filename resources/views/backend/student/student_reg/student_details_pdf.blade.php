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



<div class="card">
    <div class="card-header">
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
              <td>Id No</td>
              <td>{{ @$details['id_no'] }}</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Role</td>
              <td>{{ @$details['roll']}}</td>
            </tr>
            <tr>
              <td>3</td>
              <td>Name</td>
              <td>{{ @$details['name'] }}</td>
            </tr>
            
            
            <tr>
              <td>4</td>
              <td>Father</td>
              <td>{{ @$details['f_name'] }}</td>
            </tr>
            <tr>
              <td>5</td>
              <td>Mother</td>
              <td>{{ @$details['m_name']  }}</td>
            </tr>
            <tr>
              <td>6</td>
              <td>Gender</td>
              <td>{{ @$details['gender']  }}</td>
            </tr>
            <tr>
              <td>7</td>
              <td>Religion</td>
              <td>{{ @$details['religion']  }}</td>
            </tr>
            <tr>
              <td>8</td>
              <td>Date of Birth</td>
              <td>{{ @$details['dob'] }}</td>
            </tr>
            <tr>
              <td>9</td>
              <td>Discount</td>
              <td>{{ @$details['discount'] }}</td>
            </tr>
            <tr>
              <td>10</td>
              <td>Year</td>
              <td>{{ @$details['year']   }}</td>
            </tr>
            <tr>
              <td>11</td>
              <td>Class</td>
              <td>{{ @$details['class']  }}</td>
            </tr>
            <tr>
              <td>12</td>
              <td>Group</td>
              <td>{{ @$details['group'] }}</td>
            </tr>
            <tr>
              <td>13</td>
              <td>Shift</td>
              <td>{{ @$details['shift'] }}</td>
            </tr>
        </table>
        <br>
        <i>Print Date : {{ date('Y-M-d') }}</i>
    </div>
</div>
  
  


</body>
</html>
