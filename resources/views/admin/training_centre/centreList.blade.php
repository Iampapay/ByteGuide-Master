@extends('layout')
@section('title', $title)
@section('content')
<style>
    td {
        border: 2px solid white;
        border-radius: 5px;
        /* Optional - adds rounded corners */
        padding: 10px;
        /* Optional - adds some space between the content and the border */
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .link-button {
        display: inline-block;
        width: 150px;
        /* Set the desired width for the hyperlinks */
        background-color: #189AB4;
        color: white;
        padding: 7px;
        text-align: center;
        text-decoration: none;
        margin: 5px;
        border-radius: 3px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Training Center List
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li>Training Centre</li>
            <li class="active"><a href="{{ route('admin.centre.list') }}">Training Centre List</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        @if (Session::has('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('msg') }}
                        </div>
                        @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="StudentDataTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Basic Details</th>
                                    <th>Contact Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $a=1; @endphp
                                @forelse($users as $user)
                                <tr style="margin-bottom: 10px">
                                    <td>{{ $a }}</td>
                                    <td>
                                        <p style="background-color:#A3EBB1;padding:8px;font-family: 'Gill Sans', sans-serif;"><b>TC Name:</b> {{$user->name}}</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><b>TP Name: </b>CINETEQ SERVICES PVT LTD (PBSSD/TP/2022/PUR/4853)</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><b>District: </b>{{ $user->dist }}</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><b>Block/Municipilaty: </b>{{ $user->block }}</p>
                                        <span style="display: flex;">
                                            <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-calendar" aria-hidden="true"></i> <b>Registration Date (By TP): </b> {{date("d/m/Y", strtotime($user->created_at));}}</p>
                                            <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-calendar" aria-hidden="true"></i> <b>Final submission date (By TC): </b> N/A</p>
                                        </span>
                                    </td>
                                    <td>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-phone" aria-hidden="true"></i> <b>Phone: </b>{{ isset($user->landline_no) ? $user->landline_no : 'Not provided' }}</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-mobile" aria-hidden="true"></i> <b>Mobile: </b>{{ $user->phone_no }}</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-fax" aria-hidden="true"></i> <b>FAX: </b>{{ isset($user->fax_no) ? $user->fax_no : 'Not provided' }}</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-envelope" aria-hidden="true"></i> <b>Email: </b>{{$user->email}}</p>
                                        <p style="padding:8px;font-family: 'Gill Sans', sans-serif;"><i class="fa fa-globe"></i></i> <b>Website: </b>{{ isset($user->web_url) ? $user->web_url : 'Not provided' }}</p>

                                    </td>
                                    <td class="text-center" style="padding: 17px;">
                                        <p><a href="#" class="link-button" style="background-color:#189AB4;color:white;padding:7px;">View Profile</a></p>
                                        <p><a href="#" class="link-button" style="background-color:#603F8B;color:white;padding:7px;">New Course Request</a></p>
                                        <p><a href="#" class="link-button" style="background-color:#189AB4;color:white;padding:7px;">View Work Order</a></p>

                                    </td>
                                </tr>
                                @php $a++; @endphp
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align: center;">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table><br>
                        <div class="text-right">{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
