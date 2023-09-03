@extends('layout')
@section('title', $title)
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Edit User
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.user-manage.index') }}"><i class="fa fa-dashboard"></i> Users List</a></li>
         <!--  <li><a href="#">Forms</a></li> -->
         <li class="active"> Edit User</li>
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
                  <h3 class="box-title">User Edit Form</h3>
                  @if(Session::has('error'))
                  <div class="alert alert-danger">
                     {{ Session('error')}}
                  </div>
                  @endif
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" action="{{url('user-manage')}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="box-body">
                     <div class="form-group row @if($errors->has('f_name'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="f_name">First Name<span class="required_field">*</span></label>
                           <input type="text" name="f_name" class="form-control" value="">
                           @if($errors->has('f_name'))
                           <span class="error">{{$errors->first('f_name')}}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row @if($errors->has('l_name'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="l_name">Last Name<span class="required_field">*</span></label>
                           <input type="text" name="l_name" class="form-control" value="{{old('l_name')}}">
                           @if($errors->has('l_name'))
                           <span class="error">{{$errors->first('l_name')}}</span>
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
                     <div class="form-group row @if($errors->has('mobile'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="mobile">Mobile<span class="required_field">*</span></label>
                           <input type="text" name="mobile" class="form-control" value="{{old('mobile')}}">
                           @if($errors->has('mobile'))
                           <span class="error">{{$errors->first('mobile')}}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row @if($errors->has('country_id'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="country_id">Country<span class="required_field">*</span></label>
                           <select class="form-control" name="country_id">
                              <option value="">select</option>
                              <option></option>
                           </select>
                           @if($errors->has('country_id'))
                           <span class="error">{{$errors->first('country_id')}}</span>
                           @endif
                        </div>
                     </div>

                     <div class="form-group row @if($errors->has('citi_id'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="citi_id">City<span class="required_field">*</span></label>
                           <select class="form-control" name="citi_id">
                              <option value="">select</option>
                              <option></option>
                           </select>
                           @if($errors->has('citi_id'))
                           <span class="error">{{$errors->first('citi_id')}}</span>
                           @endif
                        </div>
                     </div>

                     <div class="form-group row @if($errors->has('address'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="address">Address<span class="required_field">*</span></label>
                           <textarea name="address" class="form-control">{{old('address')}}</textarea>
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

                     <div class="form-group row @if($errors->has('status'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="gender">Status<span class="required_field">*</span></label>
                           <select class="form-control" name="gender">
                              <option value="">select</option>
                              <option value="1" @if(old('status')==1) selected @endif>Active</option>
                              <option value="0" @if(old('status')==0) selected @endif>Inactive</option>
                           </select>
                           @if($errors->has('status'))
                           <span class="error">{{$errors->first('status')}}</span>
                           @endif
                        </div>
                     </div>

                  </div>
                  <div class="box-footer">
                     <button type="submit" class="btn btn-primary">Update User</button>
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