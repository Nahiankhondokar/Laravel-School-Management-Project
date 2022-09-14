@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Student Fee List</h3>
                <a href="{{ route('student.fee.add') }}" class="btn btn-rounded btn-info float-right">Add Student Fee</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>SL</th>
                              <th>Name</th> 
                              <th>ID NO</th> 
                              <th>Year</th> 
                              <th>Class</th> 
                              <th>Fee Type</th> 
                              <th>Amount</th> 
                              <th>Date</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($accFee as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> Student -> name }}</td>
                            <td>{{ $item -> Student -> id_no }}</td>
                            <td>{{ $item -> StudentYear -> name }}</td>
                            <td>{{ $item['StudentClass']['name'] }}</td>
                            <td>{{ $item -> FeeCategory -> name }}</td>
                            <td>{{ date('Y-m-d', strtotime($item -> date )) }}</td>
                            <td>{{ $item -> amount }}</td>
                            
                        </tr>
                        @endforeach
                          
                      </tbody>
                     
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

@endsection