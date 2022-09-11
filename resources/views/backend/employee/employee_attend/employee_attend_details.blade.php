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
                <h3 class="box-title">Employee Attendance Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">

                    <table id="" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>ID No</th>
                              <th>Date</th>
                              <th>Attend Status</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($attend as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> Student -> name }}</td>
                            <td>{{ $item -> Student -> id_no }}</td>
                            <td>{{ date('d-m-Y', strtotime($item -> date)) }}</td>
                            <td>{{ $item -> atten_status }}</td>
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