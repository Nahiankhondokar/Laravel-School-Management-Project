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
                <h3 class="box-title">Employee Salery List</h3>
                <a href="{{ route('employee.reg.create') }}" class="btn btn-rounded btn-info float-right">Add Employee Salery</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Id No</th>
                              <th>Mobile</th>
                              <th>Gender</th>
                              <th>Join Date</th>
                              <th>Salery</th>
                              @if(Auth::user() -> roll == 'Admin')
                              <th>Code</th>
                              @endif
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($employee as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> name }}</td>
                            <td>{{ $item -> id_no }}</td>
                            <td>{{ $item -> cell }}</td>
                            <td>{{ $item -> gender }}</td>
                            <td>{{ date('d-m-Y', strtotime($item -> join_date)) }}</td>
                            <td>{{ $item -> salary }}</td>

                            @if(Auth::user() -> roll == 'Admin')
                                <td>{{ $item -> code }}</td>
                            @endif 
                            
                            <td>
                                <a title="Increment" href="{{ route('employee.salery.increment', $item -> id) }}" class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            

                                <a title="Details" href="{{ route('employee.salery.details', $item -> id) }}" class="btn btn-info btn-sm"><i class="fa fa-arrow-right aria-hidden="true"></i></a>
                                
                            </td>
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