@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">

        <div class="row">
            <div class="col-12 m-auto">
                <section class="content">

                    <!-- Basic Forms -->
                    <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Student Grade Edit</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('student.grade.update', $grade -> id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf	
                                    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Grade Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="grade_name" class="form-control" value="{{ $grade -> grade_name }}"> 
                                                @error('grade_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Grade Point<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="grade_point" class="form-control" value="{{ $grade -> grade_point }}"> 
                                                @error('grade_point')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Marks<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="start_marks" class="form-control" value="{{ $grade -> start_marks }}"> 
                                                @error('start_marks')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Mark<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="end_mark" class="form-control" value="{{ $grade -> end_marks }}"> 
                                                @error('end_mark')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Start Point <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="start_point" class="form-control" value="{{ $grade -> start_point }}"> 
                                                @error('start_point')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>End Point<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="end_point" class="form-control" value="{{ $grade -> end_point }}"> 
                                                @error('start_marks')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Remark<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="remark" class="form-control" value="{{ $grade -> remarks }}"> 
                                                @error('remark')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div> 

                                <div class="text-xs-right text-center">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Add Grade">
                                </div>
                            </form>
        
                        </div>
                        <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
        
                </section>
            </div>
        </div>

    </div>
</div>

@endsection