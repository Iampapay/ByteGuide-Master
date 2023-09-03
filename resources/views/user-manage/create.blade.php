@extends('layout')
@section('title', $title)
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Create User
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.user-manage.index') }}"><i class="fa fa-dashboard"></i> Users List</a></li>
         <!--  <li><a href="#">Forms</a></li> -->
         <li class="active"> Create User</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- left column -->
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
               <div class="box-header with-border">
                  <h3 class="box-title">User Create Form</h3>
                  @if(Session::has('error'))
                  <div class="alert alert-danger">
                     {{ Session('error')}}
                  </div>
                  @endif
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form"  method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="box-body">
                     <div class="form-group row @if($errors->has('name'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="name"> Name<span class="required_field">*</span></label>
                           <input type="text" name="name" class="form-control" value="{{old('name')}}">
                           @if($errors->has('name'))
                           <span class="error">{{$errors->first('name')}}</span>
                           @endif
                        </div>
                     </div>

                     <div class="form-group row @if($errors->has('user_name'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="user_name">User Name<span class="required_field">*</span></label>
                           <input type="text" name="user_name" class="form-control" value="{{old('user_name')}}">
                           @if($errors->has('user_name'))
                           <span class="error">{{$errors->first('user_name')}}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row @if($errors->has('email'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="user_name">Email<span class="required_field">*</span></label>
                           <input type="email" name="email" class="form-control" value="{{old('email')}}">
                           @if($errors->has('email'))
                           <span class="error">{{$errors->first('email')}}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row @if($errors->has('phone_no'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="phone_no">Mobile<span class="required_field">*</span></label>
                           <input type="text" name="phone_no" class="form-control" value="{{old('phone_no')}}">
                           @if($errors->has('phone_no'))
                           <span class="error">{{$errors->first('phone_no')}}</span>
                           @endif
                        </div>
                     </div>

                     <div class="form-group row @if($errors->has('address'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="address">Address<span class="required_field">*</span></label>
                           <textarea name="" class="form-control">{{old('address')}}</textarea>
                           @if($errors->has('address'))
                           <span class="error">{{$errors->first('address')}}</span>
                           @endif
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-xs-9">
                           <label for="profile_image">Profile Image</label>
                           <input type="file" name="profile_image" class="form-control">
                        </div>
                     </div>

                     <div class="form-group row">
                        <div class="col-xs-9">
                           <label>Select Role<span class="required_field">*</span></label>
                           @if($errors->has('role_ids'))
                           <br>
                           <span class="error">{{$errors->first('role_ids')}}</span>
                           @endif
                           <div class="form-group">
                              @foreach($allRole as $role)
                              <input type="checkbox" class="minimal" name="role_ids[]" value="{{$role->id}}">&nbsp;
                              <label> {{$role->name}}</label>
                              @endforeach
                           </div>
                        </div>
                     </div>

                     <div class="form-group row @if($errors->has('password'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="password">Password<span class="required_field">*</span></label>
                           <input type="password" name="password" class="form-control" value="">
                           @if($errors->has('password'))
                           <span class="error">{{$errors->first('password')}}</span>
                           @endif
                        </div>
                     </div>

                     <div class="form-group row @if($errors->has('password_confirmation'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="password_confirmation">Confirm Password<span class="required_field">*</span></label>
                           <input type="password" name="password_confirmation" class="form-control" value="">
                           @if($errors->has('password_confirmation'))
                           <span class="error">{{$errors->first('password_confirmation')}}</span>
                           @endif
                        </div>
                     </div>

                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
               </form>
            </div>
            <!-- /.box -->
         </div>
         <!--/.col (left) -->
         <!-- right column -->
         <!--/.col (right) -->
      </div>
      <!-- /.row -->
   </section>
   <!-- /.content -->
</div>
@endsection