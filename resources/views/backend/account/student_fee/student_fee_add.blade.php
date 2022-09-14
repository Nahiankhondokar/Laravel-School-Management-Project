@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

            <form action="{{ route('student.account.fee') }}" method="POST">
              @csrf

                <div class="box bb-3 border-warning">
                <div class="box-header">
                    <h4 class="box-title"><strong>Student Fee Add</strong></h4>
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

                        <div class="col-md-3">
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Fee Category<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select name="fee_category" class="form-control" id="fee_category">
                                        <option value="">Select</option>
                                        @foreach($feeCategory as $item)
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
                                <h5>Date<span class="text-danger"></span></h5>
                                <input type="date" name="date" id="date" class="form-control">
                            </div>
                        </div>

                        
                    </div>
                        
                    <div class="col-md-3">
                        <div class="form-group">
                            <div class="controls pt-4">
                                <a href="#" class="btn btn-round btn-primary" id="StuFeeSearch">Search</a>
                            </div>
                        </div>
                    </div>

                    {{-- //// Student account fee Area //// --}}
                    <div class="box d-none" id="stu-mark-generate">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            
                        
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>SL</th>
                                        <th>Id No</th> 
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <th>Origina Fee</th>
                                        <th>Discount Fee</th>
                                        <th>Fee (This Student)</th>
                                        <th>Select</th>
                                    </tr>
                                </thead>
                                <tbody id="stu-mark-generate-body">
                                    
                                
                                    
                                </tbody>
                            </table>
                            
                        
                            <input type="submit" class="btn btn-rounded btn-info" value="Student Payment">

                    
                            

                        </div>
                    </div>
                    <!-- /.box-body -->
                    </div>
                    {{-- //// Student account fee Area //// --}}
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