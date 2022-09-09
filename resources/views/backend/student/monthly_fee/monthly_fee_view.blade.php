@extends('backend.admin_master')

@section('admin')

<!-- Handlebars File -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>


<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

            <div class="box bb-3 border-warning">
                <div class="box-header">
                    <h4 class="box-title"><strong>Student Monthly Fee</strong></h4>
                </div>
    
                <div class="box-body">
                  
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Year<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select id="year"  name="year" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($year as $item)
                                        <option value="{{ $item -> id }}" {{ (@$year_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                        @endforeach
                                    </select>
                                    @error('religion')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Class<span class="text-danger"></span></h5>
                                <div class="controls">
                                    <select id="class" name="class" class="form-control">
                                        <option value="">Select</option>
                                        @foreach($class as $item)
                                        <option value="{{ $item -> id }}" {{ (@$class_id == $item -> id) ? 'selected' : '' }}>{{ $item -> name }}</option>
                                        @endforeach
                                    </select>
                                    @error('religion')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Month<span class="text-danger"></span></h5>
                                <div class="controls">
                                 
                                    <select class="form-control" name="month" id="month">
                                        <option selected disabled="">Month</option>
                                        <option value="January">January</option>
                                        <option value="February">February</option>
                                        <option value="March">March</option>
                                        <option value="April">April</option>
                                        <option value="May">May</option>
                                        <option value="June">June</option>
                                        <option value="July">July</option>
                                        <option value="August">August</option>
                                        <option value="September">September</option>
                                        <option value="October">October</option>
                                        <option value="November">November</option>
                                        <option value="December">December</option>
                                    </select>
                                    @error('month')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="controls pt-4">
                                    <a href="#" class="btn btn-round btn-primary" id="monthlyFeeSearch">Search</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    {{-- //// Registration Fee Area //// --}}
                    <div class="row">
                        <div class="col-md-12">

                            <div id="DocumentResults">
                                <script id="document_template" type="text/x-handlebars-template">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                @{{{thsource}}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @{{#each this}}
                                            <tr>
                                                @{{{tdsource}}}
                                            </tr>
                                            @{{/each}}
                                        </tbody>
                                    </table>
                                </script>
                            </div>
                        </div>
                    </div>
                    {{-- //// Registration Fee Area //// --}}
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