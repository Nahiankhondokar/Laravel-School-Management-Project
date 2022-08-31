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
                        <h3 class="box-title text-center">Edit User</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col">
                            <form action="{{ route('user.update', $user -> id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                <div class="row">
                                <div class="col-12">	
                                    
                                        <div class="form-group">
                                            <h5>Select User Type <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="user_type" id="select" class="form-control">
                                                    <option value="">Select</option>
                                                    <option {{ ($user -> user_type == 'admin' ) ? "selected" : '' }} value="admin">Admin</option>
                                                    <option {{ ($user -> user_type == 'user' ) ? "selected" : '' }} value="user"  >User</option>
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
                                            <input type="text" name="name" class="form-control" value="{{ $user -> name }}"> 
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
                                            <input type="email" name="email" class="form-control" value="{{ $user -> email }}"> 
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <h5> Photo <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="file" class="form-control" id="inputTag"> 
                                            <br>
                                            <img id="imgPriview" class="card-img-top shadow" src="{{ ($user -> profile_photo_path) ? url('media/user/' . $user -> profile_photo_path) : url('media/no_image.jpg') }}" style="width: 100px; height : 100px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">
                                            <br>
                                            <input type="hidden" name="old_img" value="{{ $user -> profile_photo_path }}">
                                            
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
                                    <input type="submit" class="btn btn-rounded btn-info" value="Update">
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