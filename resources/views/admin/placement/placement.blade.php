@extends('layout')
@section('title', $title)
{{-- <style>
    .select2-container {
        min-width: 250px;
    }

    .select2-results__option {
        padding-right: 20px;
        vertical-align: middle;
    }

    .select2-results__option:before {
        content: "";
        display: inline-block;
        position: relative;
        height: 20px;
        width: 20px;
        border: 2px solid #e9e9e9;
        border-radius: 4px;
        background-color: #fff;
        margin-right: 20px;
        vertical-align: middle;
    }

    .select2-results__option[aria-selected=true]:before {
        font-family: fontAwesome;
        content: "\f00c";
        color: #fff;
        background-color: #f77750;
        border: 0;
        display: inline-block;
        padding-left: 3px;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #fff;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #eaeaeb;
        color: #272727;
    }

    .select2-container--default .select2-selection--multiple {
        margin-bottom: 10px;
    }

    .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
        border-radius: 4px;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #f77750;
        border-width: 2px;
    }

    .select2-container--default .select2-selection--multiple {
        border-width: 2px;
    }

    .select2-container--open .select2-dropdown--below {
        border-radius: 6px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

    }

    .select2-selection .select2-selection--multiple:after {
        content: 'hhghgh';
    }
</style> --}}
<style>
    .inp-inc {
        position: absolute;
        right: 22px;
        top: 37px;
        opacity: 70%;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>CREATE PLACEMENT</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li class="active"><a href="{{ route('admin.placement.view') }}">Placement</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="addPlacement">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-plus-square" aria-hidden="true"></i> Add Placement
                                    Details</h4>
                            </div>
                            <form id="placementForm">
                                @csrf
                                <div class="box-body">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="empl">Choose Employeer</label>
                                            <select class="form-control" name="employeer" id="empl">
                                                <option value="">~ Select Employeer ~</option>
                                                @foreach ($employeer_data as $empl_data)
                                                    <option value="{{ $empl_data->id }}">{{ $empl_data->comp_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="jTitle">Job Title<span class="required_field">*</span></label>
                                            <input type="text" name="title" class="form-control" id="jTitle"
                                                placeholder="Enter Job Title">
                                            <i class="fa fa-briefcase inp-inc" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="jDescription">
                                                Job Description<span class="required_field">*</span></label>
                                            <input type="text" name="description" class="form-control" id="jDescription"
                                                placeholder="Enter Job Description">
                                            <i class="fa fa-pencil-square inp-inc" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="jExperience">
                                                Experience<span class="required_field">*</span></label>
                                            <input type="text" name="experience" class="form-control" id="jExperience"
                                                placeholder="Enter Required Job Experience">
                                            <i class="fa fa-laptop inp-inc" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="jLocation">
                                                Preferred Location<span class="required_field">*</span></label>
                                            <input type="text" name="location" class="form-control" id="jLocation"
                                                placeholder="Enter Preferred Location">
                                            <i class="fa fa-map-marker inp-inc" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-4 text-right mt-4"><br>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                            <button type="submit" id="AddPlacementBtn"
                                                class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="editPlacement" style="display: none;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-wrench" aria-hidden="true"></i> Edit Placement Details
                                </h4>
                            </div>
                            <form id="EditplacementForm">
                                @csrf
                                <div class="box-body">
                                    <input type="hidden" id="u_id" name="update_id" value="">
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="empl">Choose Employeer</label>
                                            <select class="form-control" name="update_employeer" id="edit_empl">
                                                <option value="">~ Select Employeer ~</option>
                                                @foreach ($employeer_data as $empl_data)
                                                    <option value="{{ $empl_data->id }}">{{ $empl_data->comp_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="edit_jTitle">Job
                                                Title<span class="required_field">*</span></label>
                                            <input type="text" name="update_title" class="form-control" id="edit_jTitle"
                                                placeholder="Enter Job Title">
                                            <i class="fa fa-briefcase inp-inc" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="edit_jDescription">Job Description<span
                                                    class="required_field">*</span></label>
                                            <input type="text" name="update_description" class="form-control"
                                                id="edit_jDescription" placeholder="Enter Job Description">
                                            <i class="fa fa-pencil-square inp-inc" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="edit_jExperience">
                                                Experience<span class="required_field">*</span></label>
                                            <input type="text" name="update_experience" class="form-control"
                                                id="edit_jExperience" placeholder="Enter Required Job Experience">
                                            <i class="fa fa-laptop inp-inc" aria-hidden="true"></i>
                                        </div>

                                        <div class="col-sm-12 col-md-6 col-lg-4">
                                            <label for="edit_jLocation">Preferred Location<span
                                                    class="required_field">*</span></label>
                                            <input type="text" name="update_location" class="form-control"
                                                id="edit_jLocation" placeholder="Enter Preferred Location">
                                            <i class="fa fa-map-marker inp-inc" aria-hidden="true"></i>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-4 text-right"><br>
                                            <button type="reset" id="cancelEdit" class="btn btn-danger"><i class="fa fa-times" aria-hidden="true"></i> Cancel</button>
                                            <button type="submit" id="updatePlacementBtn"
                                                class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-list" aria-hidden="true"></i> List Of Placements</h4>
                        </div>

                        <div class="box-body">
                            <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                            <table id="PlacementTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th data-orderable="false">Sl No.</th>
                                        <th>Company Name</th>
                                        <th data-orderable="false">Company Logo</th>
                                        <th>Job Title</th>
                                        <th>Job Description</th>
                                        <th>Experience</th>
                                        <th>Preferred Location</th>
                                        <th data-orderable="false">
                                            &nbsp;&nbsp;&nbsp;&nbsp;Action
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

        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-address-card-o"
                                aria-hidden="true"></i> Job Description</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card"
                                    style="padding: 20px;border-radius: 5px; background-color: ghostwhite;">
                                    <img class="card-img-top" src="{{ url('public/dist/img/coding-e1664430458975.jpg') }}"
                                        style="height: 130px;" alt="Card image cap">
                                    <div class="card-body">
                                        <input type="hidden" id="jobId">
                                        <span class="badge bg-secondary" id="jobTitle" style="margin-top: 5px;"></span>
                                        <h6 class="card-text" id="jobDesc"></h6>
                                        <h6 class="card-text" id="jobExper"></h6>
                                        <h6 class="card-text" id="jobLoc"></h6>
                                    </div>
                                </div><br>
                                <div class="card"
                                    style="padding: 20px; border-radius: 5px; background-color: ghostwhite;">
                                    <div class="card-body">
                                        <h5 class="card-title">Write a message <i class="fa fa-pencil"
                                                aria-hidden="true"></i></h5>
                                        <textarea id="customMsg" cols="33" rows="3" placeholder="Please write a message to sent ..."
                                            style="outline: none;">This is a wonderful opportunity to start your career! XYZ currently hiring and looking for talented individuals like you. If you're interested, please register yourself using the following link :
                                            </textarea>
                                        <span class="error-message" style="display: none;color: red;">Please write a
                                            message</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="card"
                                    style="padding: 20px; border-radius: 5px; background-color: ghostwhite;">
                                    <p class="card-header" style="margin-bottom: 25px;"><i class="fa fa-th-large"
                                            aria-hidden="true"></i> List of Students</p>
                                    <div class="card-body">
                                        <table id="StudentDataTable" class="table table-striped table-bordered"
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
                                            students to send message</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times-circle"
                                aria-hidden="true"></i> close</button>
                        <button type="button" class="btn btn-success" id="sendMsg"><i class="fa fa-whatsapp"
                                aria-hidden="true"></i> send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
