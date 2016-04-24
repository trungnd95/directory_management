@extends('templates.Layouts.master')
@section('templates.head.title','List Employees')

@section ('templates.body.headTitle')
@if(Request::url() == 'http://directory.dev/employees/index')
List Employees
@if(Auth::check())
  <a href="{{route('employees.add')}}"   class="btn btn-primary btn-success"><i class="fa fa-plus"></i> Add new</a>
@endif
@elseif($employees != null)
List Employees of {{ $employees[0]->department_name}} department
@endif
@endsection

@section('templates.body.content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body  no-padding">
        <form action="{{route('employees.postSearch')}}" method="POST" class="form-horizontal" role="form" id="form-index-employee">
          {!! csrf_field() !!}
          <div class="row" style="margin:20px 10px;">
            <div class="col-lg-3">
            </div>
            <div class="col-lg-offset-3 col-lg-6">
              <div class="input-group">
              <input type="text" id="search-employee" name="search-employee" class="form-control" placeholder="Search Employee Name" value="" > 
              <select name="search-department" id="search-department" class="form-control">
                <option value="all">Choose Department</option>
                @foreach($departments as $item)
                    <option value="{{$item->slug}}">{{ $item->name }}</option>
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
              <div class="table-responsive ajax-result">
                <table class="table table-hover" id="list-departments">
                  <tr class="text-center">
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Job title</th>
                    <th> Email </th>
                    <th> Department </th>
                    @if(Auth::check())
                      <th> Action </th>
                    @endif
                  </tr>
                  @if(count($employees) > 0)
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
                  @if(Auth::check())
                    <td>
                      <a href="{{route('employees.edit',$employee->id)}}">Edit</a> | <a href="" class="text-danger delete-employee-{{$employee->id}}" data-id = "{!! $employee->id !!}" data-toggle="modal" data-target="#modal-delete-employee" >Delete</a>
                    </td>
                  @endif
                </tr>
                @endforeach
                @else 
                <p><strong>Không có nhân viên nào </strong></p>
                @endif
              </table>   
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
            @if ($employees->lastPage() > 1)
              <ul class="pagination" style="float:right; margin-top: -5px;">
              @if ($employees->currentPage() != 1)
                <li class="paginate_button previous">
                  <a href="{{ str_replace('/?', '?', $articles->url($articles->currentPage() - 1)) }}">Previous</a>
                </li>
                @endif
                @for ($i = 1;  $i <= $employees->lastPage(); $i++)
                <li class="paginate_button {{ ($employees->currentPage() == $i) ? 'active' : '' }}">
                <a href="{{ str_replace('/?', '?', $employees->url($i)) }}">{{ $i }}</a>
                </li>
                @endfor
                @if ($employees->currentPage() != $employees->lastPage() &&  $employees->lastPage() > 1)
                <li class="paginate_button next"><a href="{{ str_replace('/?', '?', $employees->url($employees->currentPage() + 1)) }}">Next</a></li>
                @endif
              </ul>
              @endif
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
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
@endsection 
