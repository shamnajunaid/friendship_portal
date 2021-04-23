@extends('layouts.apps')
@section('content')
  <body class="login-page">
     <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>Admin</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="POST" action="{{ route('login') }}">
                        @csrf
          <div class="form-group has-feedback">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
             <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
           
          </div>
          <div class="form-group has-feedback">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
           
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-4 pull-right">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
<!-- /.social-auth-links -->
<div class="row">
            <!-- /.col -->
           
                              @if (Route::has('register'))
                                <div class="col-xs-12 pull-left">
             
               <a class="" href="{{ route('register') }}">Create a new account</a>
            </div><!-- /.col -->
          </div>
                            @endif
      

      </div><!-- /.login-box-body -->
    </div>
    <!-- jQuery 2.1.3 -->
    @stop