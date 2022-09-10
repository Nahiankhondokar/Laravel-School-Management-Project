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
                <h3 class="box-title">Employee Salery Details</h3>
                <hr>
                <h4>Employee Name : <Strong>{{ $user -> name }}</Strong></h4>
                <h5>Employee ID NO : <Strong>{{ $user -> id_no }}</Strong></h5>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">

                    <table id="" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Previous Salery</th>
                              <th>Present Salery</th>
                              <th>Increment Salery</th>
                              <th>Effected date</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($salery as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> previous_salery }}</td>
                            <td>{{ $item -> present_salery }}</td>
                            <td>{{ $item -> increment_salery }}</td>
                            <td>{{ date('d-m-Y', strtotime($item -> effected_salery)) }}</td>

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