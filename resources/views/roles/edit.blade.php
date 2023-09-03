@extends('layout')
@section('title', $title)
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Role Edit
      </h1>
      <ol class="breadcrumb">
         <li><a href="{{ route('admin.role.index') }}"><i class="fa fa-dashboard"></i> Role</a></li>
         <!--  <li><a href="#">Forms</a></li> -->
         <li class="active"> Edit</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- left column -->
         <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-success">
               <div class="box-header with-border">
                  <h3 class="box-title">Role Form</h3>
                  @if(Session::has('error_msg'))
                  <div class="alert alert-danger">
                     {{ Session('error_msg')}}
                  </div>
                  @endif
               </div>
               <!-- /.box-header -->
               <!-- form start -->
               <form role="form" action="{{url('role',['id'=>$role->id])}}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="box-body">
                     <div class="form-group row @if($errors->has('name'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="name">Role Name<span class="required_field">*</span></label>
                           <input type="text" name="name" class="form-control" value="{{$role->name}}">
                           @if($errors->has('name'))
                           <span class="error">{{$errors->first('name')}}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row @if($errors->has('slug'))has-error @endif">
                        <div class="col-xs-9">
                           <label for="slug">Role Slug<span class="required_field">*</span></label>
                           <input type="text" name="slug" class="form-control" value="{{$role->slug}}">
                           @if($errors->has('slug'))
                           <span class="error">{{$errors->first('slug')}}</span>
                           @endif
                        </div>
                     </div>



                     <div class="form-group row">
                        <div class="col-xs-9">
                           <label>Permissions<span class="required_field">*</span></label>
                            @if($errors->has('permissions'))
                            <br>
                           <span class="error">{{$errors->first('permissions')}}</span>
                           @endif
                           @foreach($permissionGroup as $permissionArray)
                           <div class="form-group">
                              @foreach($permissionArray as $permissiondata)

                              <input type="checkbox" class="minimal" name="permissions[]" value="{{$permissiondata['id']}}" @if(array_key_exists($permissiondata['name'],$setpermissionArray)) checked @endif>&nbsp;
                              <label>{{$permissiondata['label']}}</label>
                              @endforeach
                           </div>
                           @endforeach
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