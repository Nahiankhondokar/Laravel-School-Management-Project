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
                        <h3 class="box-title">Employee Update</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('employee.reg.update', $employee -> id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf	
                                    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Student Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ $employee ->  name }}"> 
                                                @error('name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Father Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="f_name" class="form-control" value="{{ $employee -> f_name }}"> 
                                                @error('f_name')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Mother Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="m_name" class="form-control" value="{{ $employee -> m_name }}"> 
                                                @error('m_name')
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
                                            <h5>Mobile Number<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="cell" class="form-control" value="{{ $employee ->  cell }}"> 
                                                @error('cell')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Address<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="address" class="form-control" value="{{ $employee ->  address }}"> 
                                                @error('address')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Gender<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="gender" class="form-control" >
                                                    <option value="">Select</option>
                                                    <option value="male" {{ ($employee  -> gender == 'male') ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ ($employee  -> gender == 'female') ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @error('gender')
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
                                            <h5>Religion<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="religion" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="islam" {{ ($employee  -> religion == 'islam') ? 'selected' : '' }}>Islam</option>
                                                    <option value="hindu" {{ ($employee -> religion == 'hindu') ? 'selected' : '' }}>Hindu</option>
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
                                            <h5>Date Of Birth<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="dob" class="form-control" value="{{ $employee -> dob }}"> 
                                                @error('dob')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Designation<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="designation" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($designation as $item)
                                                    <option value="{{ $item -> id }}" {{ ($employee -> designation_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
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

                                </div>

                                <div class="row">
                                    {{-- @if(!@$employee) --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Salery<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="salery" class="form-control" value="{{ $employee -> salary }}"> 
                                                @error('salery')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Join Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="join_date" class="form-control" value="{{ $employee -> join_date }}"> 
                                                @error('join_date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    {{-- @endif --}}
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5> Photo <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="file" class="form-control" id="inputTag"> 
                                                
                                                @error('file')
                                                    <span class="text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <img id="imgPriview" class="card-img-top shadow" src="{{ ($employee -> image) ? url('media/employee/' . $employee -> image) : url('media/no_image.jpg') }}" style="width: 100px; height : 100px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">

                                        <input type="hidden" name="old_img" value="{{ $employee -> image }}">
                                    </div>

                                </div>
                                

                                <div class="text-xs-right text-center">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Update Employee">
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