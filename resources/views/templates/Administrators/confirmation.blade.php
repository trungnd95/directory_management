@extends('auth.layouts.app')
@section ('auth.head.title','Change Password')
@section ('auth.body.title','Change Password')
@section('auth.body.content')
@if(Session::has('flash_message'))
<div class="alert alert-{{Session::get('flash_level')}}">
    {{Session::get('flash_message')}}
</div>
@endif
<div class="login-box-body">
    <p class="login-box-msg">Change Password</p>
    <form method="post" action="{{route('administration.postConfirm',[$new_ad->confirmation_code])}}">
      {!! csrf_field() !!}
      <!-- <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email',isset($new_ad) ? $new_ad->email : null) }}" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div> -->
    <!-- <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Old password" name="old_password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div> -->

    <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="New password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Confirmation Password" name="password_confirmation">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>
    <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-btn fa-refresh"></i> Change Password</button>
        </div>
        <!-- /.col -->
    </div>
</form>
</div>
@endsection
