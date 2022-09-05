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
                <h3 class="box-title">Student Assign Subject Details</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                      <thead class="thead-light">
                          <tr>
                              <th>#</th>
                              <th>Subject Name</th>
                              <th>Full Mark</th>
                            <th>Pass Mark</th>
                            <th>Subjective Mark</th>
                          </tr>
                      </thead>
                      <h4>Fee Category : <strong>{{ $assign_sub[0] -> StudentClass -> name }}</strong></h4>
                
                      <tbody>

                        @foreach($assign_sub as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> SchoolSubject -> name ?? 'None' }}</td>
                            <td>{{ $item -> full_mark}}</td>
                            <td>{{ $item -> pass_mark}}</td>
                            <td>{{ $item -> subjective_mark}}</td>
                        </tr>
                        @endforeach
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            <th>Subject Name</th>
                            <th>Full Mark</th>
                            <th>Pass Mark</th>
                            <th>Subjective Mark</th>
                          </tr>
                      </tfoot>
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