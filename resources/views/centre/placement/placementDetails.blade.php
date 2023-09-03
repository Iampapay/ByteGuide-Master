@extends('layout')
@section('title', $title)
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h4>STUDENT LIST</h4>
        <ol class="breadcrumb">
            <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li>Placement</li>
            <li><a href="{{ route('centre.placement.view') }}">Placement Details</a></li>
            <li class="active"><a href="{{ route('centre.showStudent.list', ['id' => base64_encode($placement_details->id)]) }}">Student List</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><i class="fa fa-signal" aria-hidden="true"></i> List Of Students</h4>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="padding: 20px; border-radius: 5px; background-color: ghostwhite;">
                                    <label for="selectedBatch1">Choose Batch</label>
                                    <select class="form-control" name="selected_batch" id="selectedBatch">
                                        <option value="0">~ Select Batch ~</option>
                                        @foreach ($batch_details as $b_d)
                                        <option value="{{ $b_d->id }}">{{ $b_d->batch_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div><br>

                        <div class="row showStudList" style="display: none;">
                            <div class="col-md-4">
                                <div class="card" style="padding: 20px;border-radius: 5px; background-color: ghostwhite;">
                                    <div class="card-header"><span class="badge bg-secondary" id="jobTitle" style="margin-bottom: 5px;">Placement Details</span></div>
                                    @if ($emplr_details->comp_logo != 'null')
                                    <img src="{{ asset('public/company-Logo/'. $emplr_details->comp_logo .'') }}" width="139px" style="margin-bottom: -4px;">
                                    @endif
                                    <div class="card-body">
                                        <input type="hidden" id="jobId" value="{{ $placement_details->id }}">
                                        <h5 class="card-text"><b>Company Name: </b>{{ $emplr_details->comp_name }}</h5>
                                        <h5 class="card-text"><b>Job Title: </b>{{ $placement_details->job_title }}</h5>
                                        <h5 class="card-text"><b>Job Description: </b>{{ $placement_details->job_desc }}</h5>
                                        <h5 class="card-text"><b>Job Experience: </b>{{ $placement_details->job_exp }}</h5>
                                        <h5 class="card-text"><b>Job Location: </b>{{ $placement_details->job_loc }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card" style="padding: 20px; border-radius: 5px; background-color: ghostwhite;">
                                    <div class="card-body">
                                        <h5 class="card-title">Write a message <i class="fa fa-pencil" aria-hidden="true"></i></h5>
                                        <input type="text" style="margin-bottom: 5px;width: 65px;" value="Hi there ," disabled>
                                        <textarea id="customMsg" cols="115" rows="8" placeholder="Please write a message to sent ..." style="outline: none;">This is a wonderful opportunity to start your career! XYZ currently hiring and looking for talented individuals like you. If you're interested, please register yourself using the following link :
                                                </textarea>
                                        <span class="error-message" style="display: none;color: red;">Please write a
                                            message</span>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <div class="row showStudList" style="display: none;">
                            <div class="col-md-12">
                                <div class="card" style="padding: 20px; border-radius: 5px; background-color: ghostwhite;">
                                    <p class="card-header" style="margin-bottom: 25px;"><i class="fa fa-th-large" aria-hidden="true"></i> List of Students</p>
                                    <div class="card-body">
                                        <table id="StudentListDataTable" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th data-orderable="false"><input class="form-check-input" type="checkbox" id="flexCheckDefault" value="0"> Select
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
                                            students to send message</span>
                                    </div>
                                    <hr>
                                    <div class="card-footer text-right mt-3">
                                        <button type="button" class="btn btn-success" id="sendWhatsAppMsg"><i class="fa fa-whatsapp" aria-hidden="true"></i> send</button>
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
