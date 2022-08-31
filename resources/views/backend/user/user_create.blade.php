@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">

        <div class="row">
            <div class="col-6 m-auto">
                <section class="content">

                    <!-- Basic Forms -->
                    <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title text-center">Create New User</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col">
                            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <div class="col-12">	
                                    
                                        <div class="form-group">
                                            <h5>Select User Type <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="user_type" id="select" required="" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="admin">Admin</option>
                                                    <option value="user">User</option>
                                                </select>
                                            </div>
                                                @error('user_type')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>

                                    <div class="form-group">
                                        <h5>User Name<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required=""> 
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        
                                    </div>
                                    <div class="form-group">
                                        <h5> User Email <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" required=""> 
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5> User Password <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="password" name="password" class="form-control" required=""> 
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5> Photo <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="file" class="form-control" required="" id="inputTag"> 
                                            <br>
                                            <img id="imgPriview" class="card-img-top shadow" src="{{ url('media/no_image.jpg') }}" style="width: 100px; height : 100px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">
                                            <br>
                                            
                                            @error('file')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                </div>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Submit">
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