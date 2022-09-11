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
                        <h3 class="box-title ">Emloyee Attendance Edit</h3></h6>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                        <div class="col-12">
                            <form action="{{ route('employee.attend.update', $date) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf	
                                    
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <h5>Attendance Date<span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="date" name="attend_date" class="form-control" value="{{ $date }}"> 
                                                @error('start_date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                                            
                                        <table id="" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center">SL</th>
                                                    <th rowspan="2" class="text-center">Employee</th>
                                                    <th colspan="3" style="width: 30%; text-align: center">Attend Status</th>
                                                </tr>

                                                <tr>
                                                    <th class="bg-black">Present</th>
                                                    <th class="bg-black">Leave</th>
                                                    <th class="bg-black">Absent</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                              @foreach($attend as $key => $item)
                                              <tr>
                                                <input type="hidden" name="employee_id[]" value="{{ $item -> employee_id }}">
                                                <td>{{  $key + 1 }}</td>
                                                <td>{{ $item -> Student -> name }}</td>
                                                <td colspan="3">
                                                    <div class="text-center">
                                                        <input name="attend_status{{$key}}" type="radio" value="Present"  {{ ($item -> atten_status == 'Present') ? 'checked' : '' }} id="present{{$key}}">
                                                        <label for="present{{$key}}">Present</label>

                                                        <input name="attend_status{{$key}}" value="Leave" type="radio" id="leave{{$key}}" {{ ($item -> atten_status == 'Leave') ? 'checked' : '' }} >
                                                        <label for="leave{{$key}}">Leave</label>

                                                        <input name="attend_status{{$key}}" type="radio" value="Absent" class="with-gap" id="absent{{$key}}" {{ ($item -> atten_status == 'Absent') ? 'checked' : '' }} >
                                                        <label for="absent{{$key}}">Absent</label>
                                                    </div>
                                                </td>
                                            </tr>
                                              @endforeach
                                                
                                            </tbody>
                                        </table>

                                    </div>
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

@endsection