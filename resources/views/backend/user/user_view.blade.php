@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="d-flex align-items-center">
              <div class="mr-auto">
                  <h3 class="page-title">Data Tables</h3>
                  <div class="d-inline-block align-items-center">
                      <nav>
                          <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                              <li class="breadcrumb-item" aria-current="page">Tables</li>
                              <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                          </ol>
                      </nav>
                  </div>
              </div>
          </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">All User List</h3>
                <a href="{{ route('user.add') }}" class="btn btn-rounded btn-info float-right">Add User</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Photo</th>
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($user as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> name }}</td>
                            <td>{{ $item -> email }}</td>
                            <td>
                                <img src="{{ ($item -> profile_photo_path) ? url('media/user/' . $item -> profile_photo_path) : url('media/no_image.jpg') }}" alt="" width=" 30">
                            </td>
                            <td>
                                <a href="{{ route('user.edit', $item ->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a href="{{ route('user.delete', $item ->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-remove" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Photo</th>
                            <th>Aciton</th>
                          </tr>
                      </tfoot>
                    </table>
                  </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->        
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    
    </div>
</div>

@endsection