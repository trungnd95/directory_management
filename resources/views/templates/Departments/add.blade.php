@extends('templates.Layouts.master')

@section('templates.head.title','Add Department')
@section('templates.body.headTitle')
	<p class="text-center">Add Departments</p>
@endsection

@section('templates.body.content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" action="{{ route('departments.store')}}" method="post" >
          {{ csrf_field()}}
          <div class="box-body">
            
            <div class="form-group">
              <label for="office_name">Office Name</label>
              <input type="text" class="form-control" name="name" id="office_name"  placeholder="Enter office name" />
            </div>
            
            <div class="form-group">
              <label for="office_phone">Office Phone</label>
              <input type="text" class="form-control" name="office_phone" id="office_phone" placeholder="Enter office_phone"  />
            </div>
     
            <div class="form-group">
              <label for="office_code">Office Code</label>
              <input type="text" class="form-control" id="office_code" name="office_code" placeholder="Enter office code " />
            </div>
            
            <div class="form-group">
              <label for="manager">Manager </label>
              <input type="text" class="form-control" id="manager" name="manager" placeholder="Enter manager name" />
            </div>

            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" id="address" name="address" placeholder="Enter address detail" />
            </div>


            <div class="form-group">
              <label for="email_contact">Email Contact</label>
              <input type="text" class="form-control" id="email_contact" name="email_contact" placeholder="Enter email contact" />
            </div>

         </div><!-- /.box-body -->

         <div class="box-footer">
          <button type="submit" class="btn btn-primary  col-md-2">Add</button>
        </div><!--/end box-footer -->
      </form><!--/end form -->
    </div><!-- /.box -->
  
  </div>
</div>
<!-- /.content-wrapper -->
@endsection