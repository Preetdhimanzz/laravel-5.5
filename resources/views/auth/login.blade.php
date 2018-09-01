@extends('layouts.app')

@section('content')


<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0)"><b>Dhimanzz</b>TECH</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body ">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="login-form" method="POST" action="{{ url('login-user') }}">
        {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>

@endsection
