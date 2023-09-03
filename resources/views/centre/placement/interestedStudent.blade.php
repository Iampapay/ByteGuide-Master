{{-- @extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4>INTERESTED STUDENT</h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Placement</li>
                <li><a href="{{ route('centre.interested.student') }}">Interested Student</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-signal" aria-hidden="true"></i> List Of Interested
                                Students</h4>
                        </div>

                        <div class="box-body">
                            <div class="row" style="margin-bottom: 25px;">
                                <div class="col-md-8">
                                    <label for="selectedPlacement">Choose Placement</label>
                                    <select class="form-control" name="selected_placement" id="selectedPlacement">
                                        <option value="">~ Select Placement ~</option>
                                        @foreach ($placementData as $p_d)
                                            <option value="{{ $p_d->id }}">{{ $p_d->job_title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="placementValidation" style="display: none">Please select
                                        a Placement</span>
                                </div>
                                <div class="col-md-4 text-center"><br>
                                    <button id="searchInterestStudentBtn" class="btn btn-success"><i class="fa fa-search"
                                            aria-hidden="true" style="margin-top: 4px;"></i> Search Interested
                                        Students</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary interestedStudList">
                        <div class="box-header">
                            <h4>Interested Student List</h4>
                        </div>
                        <div class="box-body">
                            <div class="col-md-12">
                                <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                                <table id="interestedStudTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th data-orderable="false">Sl No.</th>
                                            <th>Job Title</th>
                                            <th>Job Location</th>
                                            <th>Student Email</th>
                                            <th>Student Phone Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection --}}

@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>INTERESTED STUDENT</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Placement</li>
                <li><a href="{{ route('centre.interested.student') }}">Interested Student</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-search-plus" aria-hidden="true"></i> Search Filters
                            </h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="selectedPlace">Choose Placement</label>
                                    <select class="form-control" name="selected_place" id="selectedPlace">
                                        <option value="">~ Select Placement ~</option>
                                        @foreach ($placementData as $p_d)
                                            <option value="{{ $p_d->id }}">{{ $p_d->job_title }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="placementValidation" style="display: none">Please select
                                        a Placement</span>
                                </div>
                                <div class="col-md-4 text-center"><br>
                                    <button id="searchInterestedStudBtn" class="btn btn-success" style="margin-top: 5px"><i class="fa fa-search"
                                            aria-hidden="true"></i> Search Interested Students</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary IntStud" style="display: none">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> List Of Interested
                                Students
                            </h4>
                        </div>

                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="interestedStudsTbl" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Job Id</th>
                                        <th>Job Location</th>
                                        <th>Student Email</th>
                                        <th>Student Phone Number</th>
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
