@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-8 m-auto">

            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                    <a href="{{ route('profile.edit', $user -> id) }}" class="btn btn-rounded btn-info float-right">Edit Profile</a>
                  <h2 class="widget-user-username">{{ $user -> name }}</h2>
                  <h5 class="widget-user-desc">{{ $user -> user_type }}</h5>
                  <h5 class="widget-user-desc">{{ $user -> email }}</h5>
                </div>
                <div class="widget-user-image">
                  <img class="rounded-circle" src="{{ ($user -> image) ? url('media/user/' . $user -> image) : url('media/no_image.jpg') }}" alt="User Avatar" style="width: 80px; height : 80px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">
                </div>
                <div class="box-footer">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Mobile No</h5>
                        <span class="description-text">{{ $user -> cell }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 br-1 bl-1">
                      <div class="description-block">
                        <h5 class="description-header">Address</h5>
                        <span class="description-text">{{ $user -> address }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                      <div class="description-block">
                        <h5 class="description-header">Gender</h5>
                        <span class="description-text">{{ $user -> gender }}</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
          
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

@endsection