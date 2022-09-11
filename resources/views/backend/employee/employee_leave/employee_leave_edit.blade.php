@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">

        <div class="row">
            <div class="col-12 m-auto">
                <section class="content">

                    <!-- Basic Forms -->
                    <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title ">Emloyee Leave Edit</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('employee.leave.update', $leave -> id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf	
                                    
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Emloyee Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="form-control" name="employee_id" required>
                                                    <option value="" selected disabled>Select</option>
                                                    @foreach($user as $item)
                                                    <option value="{{ $item -> id }}" {{ ($item -> id == $employee -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('designation')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Start Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="start_date" class="form-control" value="{{ $leave -> start_date }}"> 
                                                @error('start_date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>Leave Purpose<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="form-control" name="leave_purpose_id" id="leave_purpose">
                                                    <option value="" selected disabled>Select</option>
                                                    
                                                    @foreach($purpose as $item)
                                                    <option value="{{ $item -> id }}" {{ ($leave -> leave_purposes_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                                    @endforeach
                                                    <option value="0">New Purpose</option>
                                                </select>
                                                <br>
                                                <input type="text" class="form-control" name="new_purpose" id="new_purpose" placeholder="New Purpose" style="display: none">
                                                @error('leave_purpose')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <h5>End Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="end_date" class="form-control" value="{{ $leave -> end_date }}"> 
                                                @error('end_date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="text-xs-right text-center">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Increment">
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