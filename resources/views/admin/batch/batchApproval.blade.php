@extends('layout')
@section('title', $title)
<style>
    .single-line-dropdowns {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .form-group:nth-child(1),
    .form-group:nth-child(2) {
        flex-basis: 48%;
    }

    .form-group:not(:last-child) {
        margin-right: 0%;
    }

    .search-filter {
        margin: 0px 0 0;
        padding: 15px;
        border-radius: 5px;
    }

    .search-filter label {
        display: block;
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
    }

    .approve a,
    .reject a,
    .view a,
    .download a {
        display: inline-block;
        width: 105px;
        margin-bottom: 10px;
        padding: 2px 0;
        text-align: center;
        border: none;
        border-radius: 4px;
        color: #ffffff;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s ease;
    }

    .approve a {
        background-color: rgb(0, 158, 45);
    }

    .reject a {
        background-color: rgb(224, 0, 0);
    }

    .view a {
        background-color: black;
    }

    .download a {
        background-color: purple;
    }

    .view a:hover,
    .download a:hover {
        background-color: #444444;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th,
    .table td {
        padding: 12px;
        text-align: left;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f2f2f2;
    }

    .text {
        display: block;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        color: #333;
    }

    .light-text {
        border-radius: 20%;
        color: white;
        background-color: green;
        padding: 8px;
    }
    .badge-pill {
        display: inline-block;
        min-width: 10px;
        padding: 2px 14px;
        font-size: 14px;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        border-radius: 10px;
    }
    .badge-secondary {
        background-color: #777;
    }
    .badge-success {
        background-color: green;
    }.badge-primary {
        background-color: blue;
    }.badge-danger {
        background-color: red;
    }

    .displayNone {
        display: none;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4>List Of Batches</h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Batche Monitoring</li>
                <li class="active"><a href="{{ route('admin.batch.approval') }}">Batche Approval</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-search-plus" aria-hidden="true"></i> Search Filters
                                </h4>
                            </div>
                            <div class="box-body">
                                <div class="search-filter">
                                    <div class="single-line-dropdowns">
                                        <div class="form-group">
                                            <label for="sector">Sector :</label>
                                            <select name="sector" id="sector" class="form-control">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="course">Course :</label>
                                            <select name="course" id="course" class="form-control">
                                                <option value="">--Select--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="district">District :</label>
                                            <select name="district" id="district" class="form-control">
                                                <option value="">Select District</option>
                                                @foreach ($centre_dist as $c_dist)
                                                    <option value="{{ $c_dist->dist }}">{{ $c_dist->dist }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="training-partner">Training Partner</label>
                                            <select name="training_partner" id="training-partner" class="form-control">
                                                <option value="">--Select Training Partner--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="training-centre">Training Centre</label>
                                            <select name="training_centre" id="training-centre" class="form-control">
                                                <option value="">--Select Training Centre--</option>
                                                @foreach ($centre_details as $c_details)
                                                    <option value="{{ $c_details->id }}">{{ $c_details->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="batch-type">Batch Type</label>
                                            <select name="batch_type" id="batch-type" class="form-control">
                                                <option value="">--Select Type--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="batch-status">Batch Status</label>
                                            <select name="batch_status" id="batch-status" class="form-control">
                                                <option value="">--Select Status--</option>
                                                <option value="2">Pending</option>
                                                <option value="1">Approved</option>
                                                <option value="3">Rejected</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="buttons text-right">
                                    <button class="btn btn-primary" id="searchMatchedBatch">Search</button>
                                    <button class="btn btn-primary" style="margin-left: 10px;"><i class="fa fa-download"
                                            aria-hidden="true"></i> Export</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary" id="matchedBatch" style="display: none">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-bars" aria-hidden="true"></i> Batch List</h4>
                        </div>

                        <div class="box-body">
                            <table id="matchedBatchTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th data-orderable="false">Centre Details</th>
                                        <th data-orderable="false">Batch Details</th>
                                        <th data-orderable="false">Status</th>
                                        <th data-orderable="false">Action</th>
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
