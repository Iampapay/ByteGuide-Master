@extends('layout')
@section('title', $title)
<style>
    .inp-inc {
        position: absolute;
        right: 22px;
        top: 37px;
        opacity: 70%;
    }

    .batch-code {
        font-size: 22px;
    }

    .text {
        padding: 20px;
        /* Add padding to each text container */
    }

    /* Optional: You can adjust the font size, font weight, and color of the text */
    .text span {
        font-size: 16px;
        color: #333;
        font-weight: bold;
    }

    .date {
        padding-top: 10px;
        /* Add padding between Attendance text and the input date */
    }

    /* Optional: Add styling for the input date */
    .date input {
        width: 100%;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h4>Batch Details</h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Batche Monitoring</li>
                <li><a href="{{ route('admin.batch.approval') }}">Batche Approval</a></li>
                <li class="active"><a href="{{ route('admin.batch.view.details', ['id' => base64_encode($batchData[0]['id'])]) }}">Batch Details</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="">
                            <div class="box-header with-border">
                                <span class="batch-code">
                                    <i class="fa fa-tags" aria-hidden="true"></i> {{ $batchData[0]['batch_code'] }}
                                </span>
                                <span class="created-date text-right pull-right">
                                    Created Date: {{ date('d/m/Y', strtotime($batchData[0]['created_at'])) }}
                                </span>
                            </div>
                            <div class="box-body" style="display: flex;">
                                <div class="text">
                                    <span class="text">Starting From</span><br>
                                    <span class="data"></span><br><br>
                                    <span class="text">Sector</span><br>
                                    <span class="data"></span><br><br>
                                    <span class="text">Training Hours</span><br>
                                    <span class="data"></span><br><br>
                                </div>
                                <div class="text">
                                    <span class="text">Ends On</span><br>
                                    <span class="data"></span><br><br>
                                    <span class="text">Training Days Per Week</span><br>
                                    <span class="data"></span><br><br>
                                    <span class="text">Extension Date</span><br>
                                    <span class="data"></span><br><br>
                                </div>
                                <div class="text">
                                    <span class="text">Attendance</span><br>
                                    <span class="date">
                                        <input type="date" name="" id="" class="form-control">
                                    </span>
                                </div>
                                <div class="text">
                                    <span class="text"><b>Tp Name: </b>CINETEQ SERVICES PRIVATE LIMITED</span><br>
                                    <span class="text"><b>Tc Name: </b>{{ $batchData[0]['name'] }}</span><br>
                                    <span class="text"><b>Batch Strength: </b>{{ $studentCounting }}</span><br>
                                    <span class="text"><b>Course Name: </b></span><br>
                                    <span class="text"><b>Course Code: </b></span><br>
                                    <span class="text"><b>Course Duraction: </b></span><br>
                                    <span class="text"><b>Training Type: </b></span><br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="batchMonitoringDetailsTable" class="table table-striped table-bordered"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Appl Name</th>
                                        <th>IN TIME</th>
                                        <th>OUT TIME</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
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
