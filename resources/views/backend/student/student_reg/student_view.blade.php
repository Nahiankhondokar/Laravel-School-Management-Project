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
                <form action="">
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Year<span class="text-danger"></span></h5>
                            <div class="controls">
                                <select name="year" id="" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($year as $item)
                                    <option value="{{ $item -> id }}">{{ $item -> name }}</option>
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
                                <select name="class" id="" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($class as $item)
                                    <option value="{{ $item -> id }}">{{ $item -> name }}</option>
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
                            <div class="controls">
                                <input type="submit" value="Search" class="btn btn-round btn-dark btn-sm">
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
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($student as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> name }}</td>
                            <td>{{ $item -> name }}</td>
                            <td>
                                <a href="" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                
                                <a id="delete" href="" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-remove" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Id No</th>
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