@extends('templates.Layouts.master')

@section('templates.head.title','List Departments')
@section('templates.body.headTitle')
List Departments
<a href="{{route('departments.add')}}"   class="btn btn-primary btn-success"><i class="fa fa-plus"></i> Add new</a>
@endsection



@section('templates.body.content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body table-responsive no-padding">
        <form action="" method="POST" class="form-horizontal" role="form" id="form-index-department">
          {!! csrf_field() !!}
          <table class="table table-hover" id="list-departments">
            	<tr class="text-center">
	              <th>ID</th>
	              <th>Department Name</th>
	              <th> Phone </th>
	              <th> Office </th>
	              <th> Manager </th>
	              <th>List employees</th>
            	</tr>
            @foreach($departments as $department)
				<tr class="td-data-{{$department->id}}">
					<td>{{ $department->id }}</td>	
					<td class="department-name">
						<a href="javascript:void(0)" data-toggle="modal" data-target="#modal-view-department" department-name = "{{$department->name}}" office-phone="{{$department->office_phone}}" office-code = "{{$department->office_code}}" manager="{{$department->manager}}" address="{{$department->address}}" email-contact="{{$department->email_contact}}"><span>{{ $department->name }}</span></a>
						<div class="show-edit-delete">
							<a href="javascript:void(0)" class="edit-department" val="{{$department->id}}">Edit</a> | <a style="color: red; cursor: pointer;" data-toggle="modal" data-target="#modal-delete-department" class="delete-department-{{$department->id}}" data-id ="{{$department->id}}">Delete</a>
						</div>
					</td>	
					<td class="office_phone">{{ $department->office_phone }}</td>	
					<td class="office_code">{{ $department->office_code }}</td>	
					<td class="manager">{{ $department->manager }}</td>
					<td><a href="{{route('employees.index',[$department->slug])}}">Detail</a></td>	
				</tr>
				<tr class="hidden edit-depart-{{$department->id}}">
					<td>{{ $department->id}}</td>
					<td><input type="text" name="name" value="{{$department->name}}" class="form-control" /></td>
					<td><input type="text" name="office_phone" value="{{$department->office_phone}}" class="form-control" /></td>
					<td><input type="text" name="office_code" value="{{$department->office_code}}" class="form-control" /></td>
					<td><input type="text" name="manager" value="{{$department->manager}}" /></td>
					<td><a href="javascript:void(0)" class="save-edit-{{ $department->id}}" val="">Save</a></td>
				</tr>
            @endforeach
          </table>    
          <!-- Modal popup to confirm delete cat -->
          <div class="modal fade" id="modal-delete-department">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete Department</h4>
                </div>
                <div class="modal-body">
                  <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary confirm_del_department">Yes</button>
                </div>
              </div>
            </div>
          </div><!-- End model-->

          <!-- Modal popup to view department detail-->
          <div class="modal fade" id="modal-view-department">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Department Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered">
                          <tr>
                            <th>Name</th>
                            <td class="department-name"></td>
                          </tr>
                          <tr>
                            <th>Office Phone</th>
                            <td class="department-phone"></td>
                          </tr>
                          <tr>
                            <th>Office Code</th>
                            <td class="department-code"></td>
                          </tr>

                          <tr>
                            <th>Manager</th>
                            <td class="department-manager"></td>
                          </tr>

                          <tr>
                            <th>Address</th>
                            <td class="department-address"></td>
                          </tr>

                          <tr>
                            <th>Email Contact</th>
                            <td class="department-email"></td>
                          </tr>

                      </table>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div><!-- End model-->
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
@endsection