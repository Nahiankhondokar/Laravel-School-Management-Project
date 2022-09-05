@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

           <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Designation List</h3>
                <a href="{{ route('designation.add') }}" class="btn btn-rounded btn-info float-right">Designation Class</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Designation</th>
                              <th>Aciton</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($designation as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item -> name }}</td>
                            <td>
                                <a href="{{ route('designation.edit', $item ->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                
                                <a id="delete" href="{{ route('designation.delete', $item ->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="fa fa-remove" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        @endforeach
                          
                      </tbody>
                      <tfoot>
                          <tr>
                            <th>SL</th>
                            <th>Designation</th>
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