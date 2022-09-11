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
                <h3 class="box-title">Employee Leave List</h3>
                <a href="{{ route('employee.leave.create') }}" class="btn btn-rounded btn-info float-right">Add Employee Leave</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">

                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Employee Name</th>
                              <th>Employee Id No</th>
                              <th>Leave Purpose</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($leave as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> Student -> name }}</td>
                            <td>{{ $item -> Student -> id_no }}</td>
                            <td>{{ $item -> LeavePurpose -> name }}</td>
                            <td>{{ date('d-m-Y', strtotime($item -> start_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($item -> end_date)) }}</td>
                            
                            <td>
                                <a title="Edit" href="{{ route('employee.leave.edit', $item -> id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>

                                <a title="Delete" id="delete" href="{{ route('employee.leave.delete', $item -> id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash aria-hidden="true"></i></a>
                                
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