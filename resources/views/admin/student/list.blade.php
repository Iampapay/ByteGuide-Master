@extends('layout')
@section('title', $title)
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>Trainee List</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Trainee</li>
                <li class="active"><a href="{{ route('admin.trainee.list') }}">Trainee List</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-search-plus" aria-hidden="true"></i> Search Filters
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-8 col-lg-10">
                                    <label for="chooseCentre">Training Centre</label>
                                    <select class="form-control" name="centre" id="chooseCentre">
                                        <option value="">~ Select Centre ~</option>
                                        @foreach ($centre_details as $c_details)
                                            <option value="{{ $c_details->id }}">{{ $c_details->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="centreValidation" style="display: none">Please select
                                        a Training Centre</span>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-2 text-right"><br>
                                    <button id="searchStudentBtn" class="btn btn-success"><i class="fa fa-search"
                                            aria-hidden="true"></i> Search Students</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary traineeList" style="display: none">
                        <div class="box-header">
                            <a href="{{ route('admin.import_student.view') }}" class="btn btn-primary">Import Trainees</a>
                        </div>
                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="traineeDataTbl" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
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
