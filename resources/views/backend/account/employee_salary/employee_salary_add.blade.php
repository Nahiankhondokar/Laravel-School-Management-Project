@extends('backend.admin_master')

@section('admin')


<div class="content-wrapper">
    <div class="container-full">
   
      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-12">

            <div class="box bb-3 border-warning">
                <div class="box-header text-center">
                    <h4 class="box-title"><strong>Employee Salary Payment</strong></h4>
                </div>
    
                <div class="box-body">
                    <form action="{{ route('employee.account.store') }}" method="POST" autocomplete="off">
                    @csrf	
                                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Year<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" id="date"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls pt-4">
                                        <a href="#" class="btn btn-round btn-primary" id="accEplySearch">Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    



                        {{-- //// Registration Fee Area //// --}}
                        <div class="row">
                            <div class="col-md-12">

                                <div id="monthly_sly_div" class="d-none">
                                    <table class="table table-bordered table-striped">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>SL</th>
                                                <th>Id No</th> 
                                                <th>Student Name</th>
                                                <th>Bsic Salary</th>
                                                <th>Salary This Month</th>
                                                <th>Select</th>
                                            </tr>
                                        </thead>
                                        <tbody id="emply_table_body">
                                            
                                        </tbody>
                                    </table>

                                    <input type="submit" class="btn btn-info btn-round" value="Employ Salary Payment">

                                </div>
                            </div>
                        </div>
                        {{-- //// Registration Fee Area //// --}}

                    </form>
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