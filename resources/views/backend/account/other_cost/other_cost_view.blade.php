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
                <h3 class="box-title">Other Cost List</h3>
                <a href="{{ route('other.cost.add') }}" class="btn btn-rounded btn-info float-right">Add Other Cost</a>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                          
                        @foreach($other_cost as $key => $item)
                        <tr>
                            <td>{{ date('Y-m-d', strtotime($item -> date )) }}</td>
                            <td>{{ $item -> amount }}</td>
                            <td>{{ $item -> desc }}</td>
                            <td>
                                <img id="imgPriview" class="card-img-top shadow" src="{{ ($item -> image) ? url('media/other-cost/' . $item -> image) : url('media/no_image.jpg') }}" style="width: 50px; height : 50px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">
                            </td>
                            <td>
                                <a href="{{ route('other.cost.edit', $item ->id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <a id="delete" href="{{ route('other.cost.delete', $item ->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></a>
                            </td>
                            
                            
                        </tr>
                        @endforeach
                          
                      </tbody>
                     
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