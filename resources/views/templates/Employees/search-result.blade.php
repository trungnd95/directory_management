@extends('templates.Layouts.master')
@section('templates.head.title','Search Employee')

@section ('templates.body.headTitle')
Search Result
@endsection

@section('templates.body.content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body  no-padding">
      @if($employees != null)
        <form action="{{route('employees.postSearch')}}" method="POST" class="form-horizontal" role="form" id="form-index-employee">
          {!! csrf_field() !!}
          <div class="row" style="margin:20px 10px;">
            <div class="col-lg-offset-6 col-lg-6">
              <div class="input-group">
              <input type="text" id="search-employee" name="search-employee" class="form-control" placeholder="Search Employee Name" value="{{ $employee}}" > 
              <select name="search-department" id="search-department" class="form-control">
                <option value="all">Choose Department</option>
                @foreach($departments as $item)
                    <option value="{{$item->slug}}" 
                    @if($item->slug == $department)
                      selected
                    @endif
                    >{{ $item->name }}</option>
                @endforeach
              </select>
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat" value="seach">
                    <i class="fa fa-search"></i>
                  </button>
                </span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="table-responsive">
                <table class="table table-hover" id="list-departments">
                  <tr class="text-center">
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Job title</th>
                    <th> Email </th>
                    <th> Department </th>
                    <th> Action </th>
                  </tr>
                  @foreach($employees as $employee)
                  {{-- {{ dd($employee)}} --}}
                  <tr class="td-data-{{$employee->id}}">
                   <td>{{ $employee->id }}</td>
                   <td>
                    @if($employee->avatar)
                      <a href="{{route('employees.detail',[$employee->id])}}"><img src="{{asset('/public/upload/images/employees/'.$employee->avatar)}}" alt="" class="thumbnail" width="80px" height="80px"></a>     
                    @else
                      <img src="{{asset('/public/upload/images/default-user.png')}}" alt="" class="thumbnail" width="80px" height="80px">     
                    @endif
                  </td> 
                  <td class="employee-name">
                    <a href="{{route('employees.detail',[$employee->id])}}">
                      <span>{{ $employee->name }}</span>
                    </a>
                  </td> 
                  <td class="">{{ $employee->job_title }}</td>  
                  <td class="">{{ $employee->email }}</td>  
                  @if($employee->department_name != null)
                    <td> {{ $employee->department_name}} </td>
                  @else
                    <?php $department = DB::table('departments')->select('name')->where('id','=',$employee->department_id)->first()?>
                    <td> {{ $department->name}}</td>
                  @endif
                  <td>
                    <a href="{{route('employees.edit',$employee->id)}}">Edit</a> | <a href="" class="text-danger delete-employee-{{$employee->id}}" data-id = "{!! $employee->id !!}" data-toggle="modal" data-target="#modal-delete-employee" >Delete</a>
                  </td>
                </tr>
                @endforeach
              </table>   
            </div>
          </div>
        </div>
           
          <!-- Modal popup to confirm delete cat -->
          <div class="modal fade" id="modal-delete-employee">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete Employee</h4>
                </div>
                <div class="modal-body">
                  <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary confirm_del_employee">Yes</button>
                </div>
              </div>
            </div>
          </div><!-- End model-->
        </form>
        @else 
          <p><strong>No result found</strong></p>
        @endif
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
@endsection 
