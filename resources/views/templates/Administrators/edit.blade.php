@extends('templates.Layouts.master')

@section('templates.head.title','Edit Administrator')
@section('templates.body.headTitle')
Edit Administrator
@endsection
@section('templates.body.content')
<div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box box-primary">
        <!-- form start -->
        <form role="form" action="{{route('administation.update',[$admin->id])}}" method="post" enctype="multipart/form-data">
          {{ csrf_field()}}
          <div class="box-body">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" class="form-control" name="username" id="username" value="{{old('username',isset($admin) ? $admin->username : null)}}" placeholder="Enter username" 
              @if(\Auth::user()->id !=  $admin->id)
                disabled
              @endif
              />
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" value="{{old('email',isset($admin) ? $admin->email : null)}}" 
              @if(\Auth::user()->id !=  $admin->id)
                disabled
              @endif
              />
            </div>
            @if(\Auth::user()->id ==  $admin->id)
            <div class="form-group">
              <label for="avatar">Avatar</label>
              @if($admin->avatar == null)
              <!-- <input type="file" class="form-control" name="avatar" id="avatar"/> -->
              <div class="form-group" id="display-img" style="margin-top: 10px;"> </div>
              <div >
                <span class="btn btn-success fileinput-button">
                  <i class="glyphicon glyphicon-plus"></i>
                  <span>Add image...</span>
                  <input type="file" id="image" name="avatar" class="form-control ">
                </span>
              </div>
              
              @else 
              
              <!-- <input type="file" class="form-control" name="avatar" id="avatar"/> -->
              <div class="form-group" id="display-img" style="margin-top: 10px;"> 
                    <img src="{{asset('/public/upload/images/users/'.$admin->avatar)}}" alt="Avatar" width="150px" height="150px" class="img-avata-upload thumbnail" />
              </div>
              <div>
                <span class="btn btn-success fileinput-button">
                  <i class="glyphicon glyphicon-plus"></i>
                  <span>Change image...</span>
                  <input type="file" id="image" name="avatar">
                </span>
              </div>
              @endif
            </div>
            @endif
            @if(\Auth::user()->level == 'owner')
            <div class="form-group">
              <label for="level">Level</label>
              <select name="level" class="form-control">
               <option value="owner"
               @if($admin->level == 'owner')
               selected 
               @endif
               >Owner
               </option>
               
               <option value="admin"
               @if($admin->level == 'admin')
               selected 
               @endif
               >Admin</option>
             </select>
           </div>
           @endif
         </div><!-- /.box-body -->

         <div class="box-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div><!-- /.box -->
  
  </div>
</div>
<!-- /.content-wrapper -->
@endsection

