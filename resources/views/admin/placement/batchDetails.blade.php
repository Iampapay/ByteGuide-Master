@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Assessed Trainee List</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="{{ route('admin.placement.view') }}">Placement</a></li>
                <li><a href="{{ route('admin.placement.trainee', ['id' => $plc_ID]) }}">Trainee Placement</a></li>
                <li class="active"><a href="{{ route('admin.batch.view', ['id' => $batch_id, 'Q' => $plc_ID]) }}">Assessed Trainee List</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <input type="hidden" id="placeID" value="{{ $plc_ID }}">
                            <input type="hidden" id="batchID" value="{{ $batch_id }}">
                            <h4 class="box-title"><i class="fa fa-btc" aria-hidden="true"></i> List of Assessment
                                Passed Trainee(s) list of Batch Code: <b>{{ $batch_details->batch_code }}</b></h4>
                        </div>
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Batch Code</b></td>
                                        <td class="text-right">{{ $batch_details->batch_code }}</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Batch Start Date</b></td>
                                        <td class="text-right">{{ date("d/m/Y", strtotime($batch_details->created_at)) }}</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Tentative Assessment Date</b></td>
                                        <td class="text-right">----</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Centre Code</b></td>
                                        <td class="text-right">----</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Centre Name</b></td>
                                        <td class="text-right">{{ $centre_data->name }}</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Course Code</b></td>
                                        <td class="text-right">----</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Finalize Note</b></td>
                                        <td class="text-right">----</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Verification Complete Date</b></td>
                                        <td class="text-right">----</td>
                                    </table>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <table class="table table-striped table-bordered" style="width:100%">
                                        <td><b>Verification Complete Note</b></td>
                                        <td class="text-right">----</td>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box box-primary batchList">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> List Of Assessed Batch(s)
                            </h4>
                        </div>

                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="AssessedTraineeListTbl" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Trainee Name</th>
                                        <th>Trainee Code</th>
                                        <th>Mobile NO</th>
                                        <th>DOB</th>
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
