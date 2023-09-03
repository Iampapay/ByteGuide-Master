@extends('layout')
@section('title', $title)
<style>
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
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4>BATCH</h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active"><a href="{{ route('centre.batch.list') }}">Batches</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="addBatch">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-bold" aria-hidden="true"></i> Add Batch</h4>
                            </div>
                            <form id="batchForm">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-5">
                                            <label for="batch_name">Batch Name<span class="required_field">*</span></label>
                                            <input type="text" name="batch_name" class="form-control"
                                                placeholder="Enter Batch Name" id="batch_name">
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-5">
                                            <label for="batch_code">
                                                Batch Code<span class="required_field">*</span></label>
                                            <input type="text" class="form-control" name="batch_code"
                                                placeholder="Enter Batch Code" id="batch_code">
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-2 text-center" style="margin-top: 25px;">
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"
                                                    aria-hidden="true"></i> Reset</button>
                                            <button type="submit" id="addBatch" class="btn btn-success"><i
                                                    class="fa fa-paper-plane" aria-hidden="true"></i> Add</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="editBatch" style="display: none">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-bold" aria-hidden="true"></i> Edit Batch</h4>
                            </div>
                            <form id="editBatchForm">
                                @csrf
                                <div class="box-body">
                                    <input type="hidden" id="u_id" name="update_id" value="">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-5">
                                            <label for="edit_batch_name">Batch Name<span
                                                    class="required_field">*</span></label>
                                            <input type="text" name="edit_batch_name" class="form-control"
                                                id="edit_batch_name" placeholder="Enter Batch Name">
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-5">
                                            <label for="edit_batch_code">
                                                Batch Code<span class="required_field">*</span></label>
                                            <input type="text" name="edit_batch_code" class="form-control"
                                                id="edit_batch_code" placeholder="Enter Batch Code">
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-2 text-center" style="margin-top: 25px;">
                                            <button type="reset" id="Batch-cancelEdit" class="btn btn-danger"><i
                                                    class="fa fa-refresh" aria-hidden="true"></i> Cancel</button>
                                            <button type="submit" id="batch_update" class="btn btn-success"><i
                                                    class="fa fa-paper-plane" aria-hidden="true"></i> Update</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-id-card-o" aria-hidden="true"></i> List Of Batch</h4>
                        </div>

                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="batch_Table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Batch Name</th>
                                        <th>Batch Code</th>
                                        <th>Assigned Student</th>
                                        <th>Status</th>
                                        <th data-orderable="false" style="text-align: center;">
                                            Action
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
