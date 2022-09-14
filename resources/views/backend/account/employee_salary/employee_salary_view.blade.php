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
                <h3 class="box-title">Emloyee Salary List</h3>
                <a href="{{ route('account.employee.add') }}" class="btn btn-rounded btn-info float-right">Add Emloyee Salary</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>SL</th>
                            <th>ID NO</th>
                            <th>Eployee Name</th>
                            <th>Amount</th>
                            <th>Date</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($employeeSalay as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> Student -> id_no }}</td>
                            <td>{{ $item -> Student -> name }}</td>
                            <td>{{ $item -> amount }}</td>
                            <td>{{ date('Y-M', strtotime($item -> date )) }}</td>
                            
                            
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