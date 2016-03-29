@extends('templates.Layouts.master')
@section('templates.head.title','Employee Profile')

@section ('templates.body.headTitle')
@section('templates.body.content')
<div class="row">
	<!-- Avatar-->
	<div class="col-md-3 col-md-offset-1">
		<img src="{{asset('public/upload/images/employees/'.$employee->avatar)}}" width="250px" height="250px" alt="Avatar" class="avatar thumbnail" />
	</div>
	<!-- Information -->
	<div class="col-md-8">
		<div class="table-responsive">
			<table class="table table-hover table-borderd">
				<tr >
					<th class="text-center">Name</th>
					<td> {{ $employee->name}} </td>
				</tr>
				<tr >
					<th class="text-center">Email</th>
					<td> {{ $employee->email}} </td>
				</tr>	
				<tr >
					<th class="text-center">Department</th>
					<td> {{ $department->name}} </td>
				</tr>	
				<tr >
					<th class="text-center">Job Title</th>
					<td> {{ $employee->job_title}} </td>
				</tr>
				<tr >
					<th class="text-center">Cell Phone</th>
					<td> {{ $employee->cell_phone}} </td>
				</tr>
				<tr >
					<th class="text-center">Address</th>
					<td> {{ $employee->address}} </td>
				</tr>						
			</table>
		</div>
		<div class="backward "  style="margin-top:50px"> 
			<a href="{{route('employees.index')}}" class="btn btn-default"><i class="fa fa-backward"></i> Back </a>	
		</div>
	</div>
</div>
@endsection 
