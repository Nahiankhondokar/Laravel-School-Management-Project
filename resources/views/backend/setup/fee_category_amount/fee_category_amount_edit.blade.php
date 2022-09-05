@extends('backend.admin_master')

@section('admin')

<div class="content-wrapper">
    <div class="container-full">

        <div class="row">
            <div class="col-6 m-auto">
                <section class="content">

                    <!-- Basic Forms -->
                    <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title ">Student Fee Amount Edit</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('fee.amount.update', $fee_amount[0] -> fee_category_id) }}" method="POST" autocomplete="off">
                                @csrf	
                                    
                                <div class="form-group">
                                    <h5>Select Fee Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="fee_category" id="select" required="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($fee_category as $item)
                                            <option value="{{ $item -> id }}" {{ ($item -> id == $fee_amount[0] -> fee_category_id) ? 'selected' : '' }}>{{ $item -> name }}</option> 
                                            @endforeach
                                        </select>
                                    </div>
                                        @error('fee_category')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                @foreach($fee_amount as $amountItem)
                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                    <div class="form-row">

                                        <div class="form-group">
                                            <h5>Select Student Class<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="class[]" id="select" required="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($class as $item)
                                                    <option value="{{ $item -> id }}" {{ ($amountItem -> class_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                @error('class')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                
                                        <div class="form-group">
                                            <h5>Amount<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="amount[]" class="form-control" value="{{ $amountItem -> amount }}"> 
                                                @error('amount')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        <div class="text-xs-right">
                                            <button class="btn btn-danger btn-sm removeEvent" id=""><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <span class="btn btn-success btn-sm addEventMore" >
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                </span>
                                <br>
                                <div class="add_item">
                                    
                                </div>

                                <div class="text-xs-right text-center">
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



{{-- // Extra item --}}
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="Whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">

                <div class="form-group">
                    <h5>Select Student Class<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <select name="class[]" id="select" required="" class="form-control">
                            <option value="">Select</option>
                            @foreach($class as $item)
                            <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                            @endforeach
                        </select>
                    </div>
                        @error('class')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                </div>
        
                <div class="form-group">
                    <h5>Amount<span class="text-danger">*</span></h5>
                    <div class="controls">
                        <input type="text" name="amount[]" class="form-control"> 
                        @error('amount')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                
                <div class="text-xs-right">
                    <button class="btn btn-danger btn-sm removeEvent"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection