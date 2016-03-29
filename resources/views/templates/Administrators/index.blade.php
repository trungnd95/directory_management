@extends('templates.Layouts.master')

@section('templates.head.title','List Administrators')
@section('templates.body.headTitle')
List Administrators
@if(\Auth::user()->level == 'owner')
<a href="javascript:void(0)"  data-toggle="modal" href='#modal-id-1' data-target="#modal-id-1" class="btn btn-primary btn-success"><i class="fa fa-plus"></i> Add new</a>
@endif
@endsection


@section('templates.body.content')
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-body table-responsive no-padding">
        <form action="" method="POST" class="form-horizontal" role="form" id="form-index-admin">
          {!! csrf_field() !!}
          <table class="table table-hover" id="list-admin">
            <tr class="text-center">
              <th>ID</th>
              <th>Avatar</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
            @foreach($admins as $admin)
            <tr>
              <td>{{ $admin->id }}</td>
              <td>
                @if($admin->avatar != null)
                <img src="{{asset('/public/upload/images/users/'.$admin->avatar)}}" alt="Avatar" width="100px" height="100px" />
                @else 
                <img src="{{asset('/public/upload/images/default-user.png')}}" alt="Default user" width="100px" height="100px">
                @endif
              </td>
              <td>{{ $admin->username }}</td>
              <td>{{ $admin->email}}</td>
              <td>{{ $admin->level}}</td>
              <td>
                @if(\Auth::check())
                @if(\Auth::user()->level == 'owner' && \Auth::user()->id == $admin->id)
                  <a href="{{route('administration.edit',[$admin->id])}}" class="edit-cart" id=""><img class="tooltip-test edit" src="{{asset('public/images/edit.png')}}" alt=""></a>
                @elseif(\Auth::user()->level == 'owner' && \Auth::user()->id != $admin->id) 
                  <a href="{{route('administration.edit',[$admin->id])}}" class="edit-cart" id=""><img class="tooltip-test edit" src="{{asset('public/images/edit.png')}}" alt=""></a>
                  <a class="delete-admin delete-admin-{{ $admin->id }}" data-toggle="modal" href='#modal-delete' data-target="#modal-delete" val="{{ $admin->id }}"><img class="tooltip-test" data-original-title="Remove"  src="{{asset('public/images/remove.png')}}" alt=""></a>

                @elseif (\Auth::user()->level == 'admin' && \Auth::user()->id == $admin->id)
                  <a href="{{route('administration.edit',[$admin->id])}}" class="edit-cart" id=""><img class="tooltip-test edit" src="{{asset('public/images/edit.png')}}" alt=""></a>    
                @endif
                @endif
              </td>
            </tr>
            
            @endforeach
          </table>    
          <!-- Modal popup to confirm delete admin -->
          <div class="modal fade" id="modal-delete">
              <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title">Delete Administrator</h4>
                </div>
                <div class="modal-body">
                  <p>Are you sure?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary confirm_del">Yes</button>
                </div>
              </div>
              </div>
          </div><!-- End model-->
        </form><!-- End form-->
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    @if ($admins->lastPage() > 1)
    <ul class="pagination" style="float:right; margin-top: -5px;">
      @if ($admins->currentPage() != 1)
      <li class="paginate_button previous">
        <a href="{{ str_replace('/?', '?', $articles->url($articles->currentPage() - 1)) }}">Previous</a>
      </li>
      @endif
      @for ($i = 1;  $i <= $admins->lastPage(); $i++)
      <li class="paginate_button {{ ($admins->currentPage() == $i) ? 'active' : '' }}">
        <a href="{{ str_replace('/?', '?', $admins->url($i)) }}">{{ $i }}</a>
      </li>
      @endfor
      @if ($admins->currentPage() != $admins->lastPage() &&  $admins->lastPage() > 1)
      <li class="paginate_button next"><a href="{{ str_replace('/?', '?', $admins->url($admins->currentPage() + 1)) }}">Next</a></li>
      @endif
    </ul>
    @endif
  </div>
</div>
<!-- Modal to add administrator -->
<div class="modal fade" id="modal-id-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Admin</h4>
      </div>
      <div class="modal-body">
        <form action="" method="POST" class="form-horizontal" role="form" id="add-ad">
          {{ csrf_field() }}
          <!-- User name -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="add-username"> User name </label>  

            <div class="col-md-6">
              <input id="add-username" name="add-username" type="text" placeholder="Username" class="form-control input-md">
              <div class="err-username hidden" ><span style="color:red"></span></div>
            </div>
          </div>

          <!-- Email -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="add-email"> Email</label>  
            <div class="col-md-6">
              <input id="add-email" name="add-email" type="email" placeholder="Email" class="form-control input-md">
              <div class="err-email hidden" ><span style="color:red">Email not true</span> </div>
            </div>
          </div>
          <!-- level -->
          <div class="form-group">
            <label class="col-md-4 control-label" for="add-level">Level</label>  
            <div class="col-md-6">
              <select name="add-level" class="form-control">
                <option value="">Choose Level</option>
                <option value="owner">Owner</option>
                <option value="admin">Admin</option>
              </select>
              <div class="err-level hidden" ><span style="color:red">Please choose level</span> </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="add-admin">Add</button>
      </div>
    </div>
  </div>
</div>
<!-- /.content-wrapper -->
@endsection
