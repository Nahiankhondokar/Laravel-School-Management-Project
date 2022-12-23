@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">


            <div class="box bb-3 border-warning">
              <div class="box-header">
              <h4 class="box-title"><strong>Student Search</strong></h4>
              </div>
    
              <div class="box-body">
                <form action="{{ route('student.search') }}" method="GET">
                  {{-- @csrf --}}
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Year<span class="text-danger"></span></h5>
                            <div class="controls">
                                <select name="year" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($year as $item)
                                    <option value="{{ $item -> id }}" {{ (@$year_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                    @endforeach
                                </select>
                                @error('religion')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Class<span class="text-danger"></span></h5>
                            <div class="controls">
                                <select name="class" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($class as $item)
                                    <option value="{{ $item -> id }}" {{ (@$class_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                    @endforeach
                                </select>
                                @error('religion')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="controls pt-4">
                                <input type="submit" value="Search" name="search" class="btn btn-round btn-dark">
                            </div>
                        </div>
                    </div>
                  </div>
                
                </form>
              </div>
            </div>


           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Student List</h3>
                <a href="{{ route('student.register') }}" class="btn btn-rounded btn-info float-right">Student Register</a>
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
                              <th>Roll</th>
                              <th>Year</th>
                              <th>Class</th>
                              {{-- @if(Auth::user() -> roll == 'Admin') --}}
                              <th>Code</th>
                              {{-- @endif --}}
                              <th>Image</th>
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($student as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> Student -> name }}</td>
                            <td>{{ $item -> Student -> id_no }}</td>
                            <td>{{ $item -> roll }}</td>
                            <td>{{ $item['StudentYear']['name'] }}</td>
                            <td>{{ $item -> StudentClass -> name }}</td>
                            <td>{{ $item -> Student -> code }}</td>
                            <td>
                              <img id="imgPriview" class="card-img-top shadow" src="{{ ($item -> Student -> image) ? url('media/student/' . $item -> Student -> image) : url('media/no_image.jpg') }}" style="width: 50px; height : 50px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">
                            </td>
                            <td>
                                <a title="Edit" href="{{ route('student.edit', $item -> student_id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                
                                <a title="Promotion" href="{{ route('student.promotion', $item -> student_id) }}" class="btn btn-primary btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>

                                <a title="PDF" target="_blank" href="{{ route('student.details', $item -> student_id) }}" class="btn btn-info btn-sm"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                
                            </td>
                        </tr>
                        @endforeach
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Id No</th>
                            <th>Roll</th>
                            <th>Year</th>
                            <th>Class</th>
                            <th>Code</th>
                            <th>Image</th>
                            <th>Aciton</th>
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