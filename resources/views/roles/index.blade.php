@extends('layout')
@section('title', $title)
@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Role List
      </h1>
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
              <a href="{{route('admin.role.create')}}" class="btn btn-primary">Creat New</a>
              <!-- <h3 class="box-title">Hover Data Table</h3> -->
            </div>
            <!-- /.box-header -->

            <div class="box-body">
              <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Sl No.</th>
                  <th>Name</th>
                  <th>Slug</th>
                  <th>Permissions</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @php $count=1; @endphp
                @forelse($roles as $role)
                  <tr>
                    <td>{{$count}}</td>
                    <td>{{$role->name}}</td>
                    <td>{{$role->slug}}</td>
                    <td>{{@$role->getPermissions($role->permission_array) }}</td>
                    <td>{{$role->status_text}}</td>
                    <td>
                      @if($role->slug!= 'superadmin')
                      <a href="{{route('admin.role.edit', ['id'=>$role->id])}}" class="glyphicon glyphicon-pencil"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                      @php
                        $deleteroute = route('admin.role.delete', ['id'=>$role->id]);
                      @endphp
                         <a href="javascript:void(0)" onclick="deleteData('{{$deleteroute}}','{{csrf_token()}}')" class="glyphicon glyphicon-remove"></a>
                      @endif
                    </td>
                  </tr>
                  @php $count++; @endphp
               @empty
                <tr>
                  <td colspan="6" style="text-align: center;">No data available</td>
                </tr>
               @endforelse


                </tbody>

              </table>
              <div>{{ $roles->links() }}</div>

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
