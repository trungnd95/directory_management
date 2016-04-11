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
  @foreach($results as $employee)
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
</table> 