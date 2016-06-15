@extends('templates.Layouts.master')
@section('templates.head.title','List Administrators')

@section('templates.body.content')
<div class="box">
	<div class="box-header">
		<h2 class="text-center title-header">Change Password</h2>
	</div>
	<div class="box-body" style="padding: 25px">
		<form action="{{route('administrator.changePassword.postData',[Auth::user()->id])}}" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data" role="form" id="form-change-password">
			{{csrf_field()}}
			<div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">  
				<label for="old_password" class="col-sm-2 control-label">Current Password</label>         	
				<div class="col-md-10">
					<input id="old_password" name="old_password" type="password" class="form-control" required placeholder="Old Passowrd..." data-id="{{Auth::user()->id}}">
					<span class="text-danger error_old_password hidden" style="color:red" >Current Password not true !!!</span>
				</div>
				@if ($errors->has('old_password'))
				<span class="help-block">
					<strong>{{ $errors->first('old_password') }}</strong>
				</span>
				@endif
			</div>

			<div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
				<label for="new_password" class="col-sm-2 control-label">New Passowrd</label>
				<div class="col-md-10">
					<input id="new_password" name="new_password" type="password" class="form-control" required placeholder="New Password ..." >
				</div>            
				@if ($errors->has('new_password'))
				<span class="help-block">
					<strong>{{ $errors->first('new_password') }}</strong>
				</span>
				@endif
			</div>
			
			<div class="form-group{{ $errors->has('re_new_password') ? ' has-error' : '' }}">
				<label for="re_new_password" class="col-sm-2 control-label">New Password Confirmation </label>
				<div class="col-md-10">
					<input id="re_new_password" name="re_new_password" type="password" class="form-control"  required placeholder="Retype new password ... ">	
				</div>
				@if ($errors->has('re-new-password'))
				<span class="help-block">
					<strong>{{ $errors->first('re-new-password') }}</strong>
				</span>
				@endif
			</div>
			<div class="form-group" style="margin-top: 50px">
				<div class="col-sm-10 col-sm-offset-2">
					<button type="submit" class="btn btn-primary" style="width: 49%">Change</button>
					<button type="reset" class="btn btn-danger" style="width: 50%">Reset</button>
				</div>
			</div>
		</form>
	</div>
</div>
		
@endsection 

