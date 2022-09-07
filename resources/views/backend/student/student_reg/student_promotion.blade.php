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
                        <h3 class="box-title">Student Promotion</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('student.promotion.update', $student -> student_id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf	
                                    
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Student Name<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" value="{{ $student -> Student -> name }}"> 
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
                                                <input type="text" name="f_name" class="form-control" value="{{ $student -> Student -> f_name }}"> 
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
                                                <input type="text" name="m_name" class="form-control" value="{{ $student -> Student -> m_name }}"> 
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
                                                <input type="text" name="cell" class="form-control" value="{{ $student -> Student -> cell }}"> 
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
                                                <input type="text" name="address" class="form-control" value="{{ $student -> Student -> address }}"> 
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
                                                    <option value="male" {{ ($student -> Student -> gender == 'male') ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ ($student -> Student -> gender == 'female') ? 'selected' : '' }}>Female</option>
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
                                                    <option value="islam" {{ ($student -> Student -> religion == 'islam') ? 'selected' : '' }}>Islam</option>
                                                    <option value="hindu" {{ ($student -> Student -> religion == 'hindu') ? 'selected' : '' }}>Hindu</option>
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
                                                <input type="date" name="dob" class="form-control" value="{{ $student -> Student -> dob }}"> 
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
                                            <h5>Discount<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="discount" class="form-control" value="{{ $discount -> discount }}"> 
                                                @error('discount')
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
                                            <h5>Year<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="year" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($year as $item)
                                                    <option value="{{ $item -> id }}" {{ ($student -> year_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
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
                                            <h5>Class<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($class as $item)
                                                    <option value="{{ $item -> id }}" {{ ($student -> class_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
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
                                            <h5>Group<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="group" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($group as $item)
                                                    <option value="{{ $item -> id }}" {{ ($student -> group_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Shift<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="shift" id="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($shift as $item)
                                                    <option value="{{ $item -> id }}" {{ ($student -> shift_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('shift')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
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
                                    <div class="col-md-4">
                                        <img id="imgPriview" class="card-img-top shadow" src="{{ ($student -> Student -> image) ? url('media/student/' . $student -> Student -> image) : url('media/no_image.jpg') }}" style="width: 100px; height : 100px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">

                                        <input type="hidden" name="old_img" value="{{ $student -> Student -> image }}">
                                    </div>
                                </div>
                                

                                <div class="text-xs-right text-center">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Promotion">
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