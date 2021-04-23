 @extends('layouts.layout')
@section('title', 'Edit Profile')
@section('content')
 <section class="content-header">
          <h1>
            Edit
            <small>Profile</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="#">Edit</a></li>
            <li class="active">Profile</li>
          </ol>

                <div class="pull-left " >
                        @if(@$user->img)
                        <img height="100" width="100" src="{{ asset('public/images/'.$user->img)}}">
                    @endif
                  </div>
           
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <!-- left column -->
            <div class="col-md-12 ">
              <!-- general form elements -->
              <div class="box box-primary">
              @if (Session::has('success'))
            <div class="row">
              <div class="form-group col-md-6">
               <h4>{{ Session::get('success') }}</h4>
             </div>
          
            </div>
    
              @endif
                <!-- form start -->
                 <form method="post" id="form" action="{{url('/user/'.$user->id.'?_method=PUT')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <div class="box-body">

                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="title">Name</label>
                                   <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if(old('name')){{ old('name') }}@else {{$user->name}}@endif" required autocomplete="name" autofocus placeholder="Full Name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                 <div class="row">
                        <div class="form-group col-md-6">
                          <label for="title">Email</label>
                                   <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="@if(old('email')){{ old('email') }}@else {{$user->email}}@endif" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                          <label for="title">Photo</label>
                                   <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image"   autofocus >

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                          <label>
                            <input type="radio" value="M" name="gender" @if(old('gender')=='M') Checked @endif @if($user->gender=='M') Checked @endif class="minimal" /> Male
                          </label>
                          <label>
                            <input type="radio" value="F" name="gender" @if(old('gender')=='F') Checked @endif @if($user->gender=='F') Checked @endif class="minimal" /> Female
                          </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                          <label for="title">Password</label>
                                   <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                          <label for="title">Confirm Password</label>
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" placeholder="Retype Password">
                        </div>
                    </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
          
                </div><!-- /.box-body -->
              </div><!-- /.box -->
             <!-- /.row -->
        </section><!-- /.content -->
         
        @stop