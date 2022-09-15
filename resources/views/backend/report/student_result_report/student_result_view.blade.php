@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

            <form action="{{ route('student.result.report.get') }}" method="GET" target="_blank">

                <div class="box bb-3 border-warning">
                <div class="box-header text-center">
                    <h4 class="box-title"><strong>Student Result Report</strong></h4>
                </div>
        
                <div class="box-body">
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Year<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select id="year"  name="year" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($year as $item)
                                        <option value="{{ $item -> id }}" >{{ $item -> name }}</option>
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Class<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select id="class_select" name="class" class="form-control">
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Exam Type<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="exam" class="form-control" id="">
                                        <option value="">Select</option>
                                        @foreach($exam_type as $item)
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
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="controls pt-4">
                                    {{-- <a href="#" class="btn btn-round btn-primary" id="">Search</a> --}}
                                    <input type="submit" class="btn btn-rounded btn-info f-right" value="Search">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                        

                    {{-- //// Student Mark Generate Area //// --}}
                    <div class="box d-none" id="stu-mark-generate">
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
                                        <th>Mark</th>
                                    </tr>
                                </thead>
                                <tbody id="stu-mark-generate-body">
                                    
                                
                                    
                                </tbody>
                            </table>
                            
                            <input type="submit" class="btn btn-rounded btn-info f-right" value="Mark Generate">

                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    {{-- //// Student Mark Generate Area //// --}}
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