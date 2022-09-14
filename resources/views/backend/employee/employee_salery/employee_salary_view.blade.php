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
                    <h4 class="box-title"><strong>Employee Monthly Salary</strong></h4>
                </div>
    
                <div class="box-body">
                    <form action="" method="POST" autocomplete="off">
                    @csrf	
                                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Date<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="date" name="date" class="form-control" id="date"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls pt-4">
                                        <a href="#" class="btn btn-round btn-primary" id="empy_salary">Search</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>



                    {{-- //// Registration Fee Area //// --}}
                    <div class="row">
                        <div class="col-md-12">

                            <div id="monthly_sly_div" class="d-none">
                                <table class="table table-bordered table-striped">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>SL</th>
                                            <th>Eployee Name</th>
                                            <th>Basic Salary</th>
                                            <th>Total Salary</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="emply_table_body">
                                        
                                    </tbody>
                                </table>
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