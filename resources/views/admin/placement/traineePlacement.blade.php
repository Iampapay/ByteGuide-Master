@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Trainee Placement</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="{{ route('admin.placement.view') }}">Placement</a></li>
                <li class="active"><a href="{{ route('admin.placement.trainee', ['id' => $placement_id]) }}">Trainee
                        Placement</a></li>
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
                                <div class="col-sm-12 col-md-8 col-lg-10">
                                    <input type="hidden" id="plcID" value="{{ $placement_id }}">
                                    <label for="selectedCentre">Training Centre</label>
                                    <select class="form-control" name="centre" id="selectedCentre">
                                        <option value="">~ Select Centre ~</option>
                                        @foreach ($centre_details as $c_details)
                                            <option value="{{ $c_details->id }}">{{ $c_details->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger" id="centreValidation" style="display: none">Please select
                                        a Training Centre</span>
                                </div>
                                <div class="col-sm-12 col-md-4 col-lg-2 text-right"><br>
                                    <button id="searchBatchBtn" class="btn btn-success"><i class="fa fa-search"
                                            aria-hidden="true"></i> Find Batch</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary batchList" style="display: none">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> List Of Assessed Batch(s)
                            </h4>
                        </div>

                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="traineeBatchTbl" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Batch Code</th>
                                        <th>Batch Start Date</th>
                                        <th>Tentative Assessment Date</th>
                                        <th>Course Code</th>
                                        <th>Status</th>
                                        <th data-orderable="false">
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action
                                        </th>
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
