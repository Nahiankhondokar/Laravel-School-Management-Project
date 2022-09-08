@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

            <form action="{{ route('student.roll.generate') }}" method="POST">
              @csrf

            <div class="box bb-3 border-warning">
              <div class="box-header">
                <h4 class="box-title"><strong>Student Role Generate</strong></h4>
              </div>
    
              <div class="box-body">
                  
                  <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Year<span class="text-danger"></span></h5>
                            <div class="controls">
                                <select id="year"  name="year" class="form-control">
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
                                <select id="class" name="class" class="form-control">
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
                                <a href="#" class="btn btn-round btn-primary" id="roleSearch">Search</a>
                            </div>
                        </div>
                    </div>
                  </div>
                      

                  {{-- //// Role Generate Area //// --}}
                  <div class="box d-none" id="role-generate">
                  <!-- /.box-header -->
                  <div class="box-body">
                      <div class="table-responsive">
                        

                          <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                                <tr>
                                    <th>Id No</th>
                                    <th>Student Name</th>
                                    <th>Father Name</th>
                                    <th>Gender</th>
                                    <th>Roll</th>
                                </tr>
                            </thead>
                            <tbody id="role-generate-body">
                                
                              
                                
                            </tbody>
                          </table>
                        
                          <input type="submit" class="btn btn-rounded btn-info" value="Roll Generate">

                      </div>
                  </div>
                  <!-- /.box-body -->
                  </div>
                {{-- //// Role Generate Area //// --}}
              </div>
                
              
            </div>


          </form>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

@endsection