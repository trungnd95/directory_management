@extends('templates.Layouts.master')

@section('templates.head.title','Edit Employee')
@section('templates.body.headTitle')
<p class="text-center">Edit Employee</p>
@endsection

@section('templates.body.content')
<div class="row">
  <div class="col-md-10 col-md-offset-1">
    <div class="box box-primary">
      <!-- form start -->
      <form role="form" action="{{ route('employees.update',[$employee->id]) }}" method="post" enctype="multipart/form-data">
        {{ csrf_field()}}
        <div class="box-body">
          <!-- Name-->
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name"  placeholder="Enter Employee name" value = {!! old('name', isset($employee) ? $employee->name : null) !!} >
          </div>
          <!-- Avatar-->
          <div class="form-group">
            <label for="employee_avatar">Avatar</label>
            <div class="form-group" id="display-img" style="margin-top: 10px;"> 
                @if($employee->avatar != null) 
                  <img src="{{asset('/public/upload/images/employees/'.$employee->avatar)}}" alt="" class="thumbnail" width="150px" height="150px" />
                @endif
            </div>
            <div >
              <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Add image...</span>
                <input type="file" id="image" name="employee_avatar" class="form-control" />
              </span>
            </div>
          </div>
          <!-- Job Title-->
          <div class="form-group">
            <label for="job_title">Job Title</label>
            <input type="text" class="form-control" name="job_title" id="job_title"  placeholder="Enter Employee  Job Title" value = {!! old('job_title',isset($employee) ? $employee->job_title : null) !!} >
          </div>            
          <!-- Cell Phone-->
          <div class="form-group">
            <label for="cell_phone">Cell Phone</label>
            <input type="text" class="form-control" name="cell_phone" id="cell_phone"  placeholder="Enter Employee Cell Phone" value = {!! old('cell_phone',isset($employee) ? $employee->cell_phone : null) !!} >
          </div>
          <!-- Email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Employee Email" value = {!! old('email',isset($employee) ? $employee->email : null) !!} >
          </div>
          <!-- Address -->
          <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" name="address" id="address"  placeholder="Enter Employee  Address" value = {!! old('address',isset($employee) ? $employee->address : null) !!} >
          </div>
          <!-- Department-->
          <div class="form-group">
            <label class="col-md-4 control-label" for="department">Choose Department</label>
            <div class="col-md-4">
              <select id="department" name="department" class="form-control">
                <option value="">Choose Department</option>
                @foreach($departments as $department)
                <option value="{{ $department->id }}"
                @if($employee->department_id == $department->id)
                  selected
                @endif 
                >{{ $department->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div><!-- /.box-body -->

        <div class="box-footer">
          <button type="submit" class="btn btn-primary  col-md-6">Edit</button>
          <button type="reset" class="btn btn-danger  col-md-6">Reset</button>
        </div><!--/end box-footer -->
      </form><!--/end form -->
    </div><!-- /.box -->

  </div>
</div>
<!-- /.content-wrapper -->
@endsection