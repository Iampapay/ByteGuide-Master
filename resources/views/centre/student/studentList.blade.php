@extends('layout')
@section('title', $title)
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h5>STUDENT LIST</h5>
            <ol class="breadcrumb">
                <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Registration</li>
                <li class="active"><a href="{{ route('centre.student.list-view') }}">Student List</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-signal" aria-hidden="true"></i> List of Students</h4>
                        </div>
                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="studListTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone No</th>
                                        <th>Aadhaar No</th>
                                        <th>Dob</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
