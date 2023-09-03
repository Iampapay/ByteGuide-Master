@extends('layout')
@section('title', $title)
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h5>ASSIGN STUDENT</h5>
            <ol class="breadcrumb">
                <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="{{ route('centre.batch.list') }}">Batches</a></li>
                <li class="active"><a href="{{ route('centre.student.list', ['id' => base64_encode($batch_details->id)]) }}">Assign Student</a></li>
            </ol>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-signal" aria-hidden="true"></i> Student List</h4>
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card text-center" style="padding: 10px;margin-bottom: 10px">
                                        <input type="hidden" value="{{ $batch_details->id }}" id="batchID">
                                        <h4 class="mt-5">{{ $batch_details->batch_name }}</h4>
                                        <h4 class="mb-5">{{ $batch_details->batch_code }}</h4>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="card" style="padding: 20px;">
                                        <table id="studListToAssingBatch" class="table table-striped table-bordered"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th data-orderable="false"><input class="form-check-input"
                                                            type="checkbox" id="flexCheckDefault" value="0"> Select
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Email Id</th>
                                                    <th>Phone</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <span class="error-check" style="display: none;color: red;">Please select
                                            students to to assign batch</span>
                                        <div class="card-footer text-right mt-3">
                                            <button type="button" class="btn btn-success" id="assignBatchBtn">Assign Batch <i class="fa fa-arrow-up" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
