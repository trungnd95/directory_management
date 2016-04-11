@extends('auth.layouts.app')

@section('auth.head.title','Login')

@section('auth.body.title','Login')

@section('auth.body.content')
<div class="login-box-body">
    <p class="login-box-msg">Login</p>
        
    <form method="post" method="{{ url('/login') }}">
        {!! csrf_field() !!}
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" >
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck" style="margin-left: 25px">
            <label>
              <input type="checkbox" name="remember" value="1" > Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng Nhập</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ url('/password/reset') }}">I forgot my password</a><br/>

  </div>
  <!-- /.login-box-body -->
@endsection
