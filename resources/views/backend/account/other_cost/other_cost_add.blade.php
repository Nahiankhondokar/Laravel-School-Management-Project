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
                        <h3 class="box-title ">Add Other Cost</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('other.cost.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf	
                                    
                               
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Amount<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="amount" class="form-control"> 
                                                @error('amount')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="date" class="form-control">
                                                @error('date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
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
                                        <img id="imgPriview" class="card-img-top shadow" src="{{ url('media/no_image.jpg') }}" style="width: 50px; height : 50px; border-radius : 50%;border: 1px solid gray;margin: auto;display: block; object-fit: cover;">
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">Description</label>
                                        <textarea name="desc" placeholder="Description..." id="" rows="3" width="100%" class="form-control"></textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="text-xs-right text-center">
                                    <input type="submit" class="btn btn-rounded btn-info" value="Add Other Cost">
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