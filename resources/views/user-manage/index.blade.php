@extends('layout')
@section('title', $title)
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User Manage

      </h1>
      <ol class="breadcrumb">
        <!-- <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>

        <li class="active">Banner</li> -->
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              @if(Session::has('msg'))
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('msg')}}
              </div>
              @elseif(Session::has('error'))
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('error')}}
              </div>

              @endif
              <a href="{{route('admin.user-manage.create')}}" class="btn btn-primary">Creat New</a>
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone No</th>
                  <th>Content</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $a=1; @endphp
                @forelse($users as $user)
                <tr>
                  <td>{{$a}}</td>
                  <td></td>
                  <td>{{$user->email}}</td>
                  <td>{{@$user->phone_no}}</td>
                  <td>{{$user->address}}</td>
                  <td>{{$user->status_text}}</td>
                  <td>
                   <a href="{{route('admin.user-manage.edit', ['id'=>$user->id])}}" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                @php
                  $deleteroute = route('admin.user-manage.delete', ['id'=>$user->id]);
                @endphp
                   <a href="javascript:void(0)" onclick="deleteData('{{$deleteroute}}','{{csrf_token()}}')" class="glyphicon glyphicon-remove"></a>
                  </td>
                  </tr>
                   @php $a++; @endphp
               @empty
                <tr>
                  <td colspan="6" style="text-align: center;">No data available</td>
                </tr>
               @endforelse
                </tbody>

              </table>
              <div>{{ $users->links() }}</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>

  @endsection
