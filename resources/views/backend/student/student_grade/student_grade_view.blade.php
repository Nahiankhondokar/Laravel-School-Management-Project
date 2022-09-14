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
                <h3 class="box-title">Student Garde List</h3>
                <a href="{{ route('student.grade.add') }}" class="btn btn-rounded btn-info float-right">Add Student Garde</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Grade Name</th> 
                              <th>Grade Point</th> 
                              <th>Start Marks</th> 
                              <th>End Marks</th> 
                              <th>Point Range</th> 
                              <th>Remark</th> 
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($grade as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> grade_name }}</td>
                            <td>{{ $item -> grade_point }}</td>
                            <td>{{ $item -> start_marks }}</td>
                            <td>{{ $item -> end_marks }}</td>
                            <td>{{ $item -> start_point }} - {{ $item -> end_point }}</td>
                            <td>{{ $item -> remarks }}</td>
                            <td>
                                <a href="{{ route('student.grade.edit', $item ->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
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