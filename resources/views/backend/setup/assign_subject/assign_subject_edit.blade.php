@extends('backend.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-full">

        <div class="row">
            <div class="col-12 m-auto">
                <section class="content">

                    <!-- Basic Forms -->
                    <div class="box">
                    <div class="box-header with-border text-center">
                        <h3 class="box-title ">Assign Subject Edit</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('assign.subject.update', $assign_sub[0] -> class_id) }}" method="POST"  autocomplete="off">
                                @csrf	
                                    

                                <div class="form-group">
                                    <h5>Select Student Class<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="class" id="select" required="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach($class as $item)
                                            <option value="{{ $item -> id }}" {{ ($assign_sub[0] -> class_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                        @error('class')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>

                                @foreach($assign_sub as $assignItem)
                                <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                                <div class="row">

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Select Subject <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subject[]" id="select" required="" class="form-control">
                                                    <option value="">Select</option>
                                                    @foreach($subject as $item)
                                                    <option value="{{ $item -> id }}" {{ ($item -> id == $assignItem -> subject_id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                                @error('subject')
                                                <span class="text-danger" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Full Mark<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="full_mark[]" class="form-control" value="{{ $assignItem -> full_mark }}"> 
                                                @error('full_mark')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Pass Mark<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="pass_mark[]" class="form-control" value="{{ $assignItem -> pass_mark }}"> 
                                                @error('pass_mark')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <h5>Subjective Mark<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="subjective_mark[]" class="form-control" value="{{ $assignItem -> subjective_mark }}"> 
                                                @error('subjective_mark')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                
                                    <div class="col-md-1">
                                        <div class="text-xs-right">
                                            <button class="btn btn-danger btn-sm removeEvent"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                                        </div>
                                        
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



{{-- // Extra item --}}
<div style="visibility: hidden">
    <div class="whole_extra_item_add" id="Whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="form-row">

                <div class="row">

                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Select Subject <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subject[]" id="select" required="" class="form-control">
                                    <option value="">Select</option>
                                    @foreach($subject as $item)
                                    <option value="{{ $item -> id }}">{{ $item -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                                @error('subject')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Full Mark<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="full_mark[]" class="form-control"> 
                                @error('full_mark')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <h5>Pass Mark<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="pass_mark[]" class="form-control"> 
                                @error('pass_mark')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <h5>Subjective Mark<span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subjective_mark[]" class="form-control"> 
                                @error('subjective_mark')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-1">
                        <div class="text-xs-right">
                            <button class="btn btn-danger btn-sm removeEvent"><i class="fa fa-minus-circle" aria-hidden="true"></i></button>
                        </div>
                        
                    </div>

                </div>
                
                
            </div>
        </div>
    </div>
</div>





@endsection