@extends('layout')
@section('title', $title)
<style>
    .inp-inc {
        position: absolute;
        right: 22px;
        top: 37px;
        opacity: 70%;
    }
</style>
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
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>REGISTER EMPLOYER</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li class="active"><a href="{{ route('admin.employeer.view') }}">Employer</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="addEmployeer">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-registered" aria-hidden="true"></i> Register Employer</h4>
                        </div>
                        <form id="employeerForm" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="cName">Company Name<span class="required_field">*</span></label>
                                        <input type="text" name="comp_name" class="form-control" id="cName" placeholder="Enter Company Name">
                                        <i class="fa fa-building inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="cAddress">
                                            Company Address<span class="required_field">*</span></label>
                                        <input type="text" name="comp_address" class="form-control" id="cAddress" placeholder="Enter Company Address">
                                        <i class="fa fa-location-arrow inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="cLogo">
                                            Company Logo<span class="required_field">*</span></label>
                                        <input type="file" name="comp_logo" class="form-control" id="cLogo" placeholder="Choose an Image">
                                        <i class="fa fa-gg inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 text-center" style="margin-top: 25px;">
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="addEmployeerBtn" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="editEmployeer" style="display: none">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-registered" aria-hidden="true"></i> Edit Employer</h4>
                        </div>
                        <form id="editEmployeerForm">
                            @csrf
                            <div class="box-body">
                            <input type="hidden" id="u_id" name="update_id" value="">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="cName">Company Name<span class="required_field">*</span></label>
                                        <input type="text" name="comp_name" class="form-control" id="Edit_cName" placeholder="Enter Company Name">
                                        <i class="fa fa-building inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="cAddress">
                                            Company Address<span class="required_field">*</span></label>
                                        <input type="text" name="comp_address" class="form-control" id="Edit_cAddress" placeholder="Enter Company Address">
                                        <i class="fa fa-location-arrow inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3">
                                        <label for="cLogo">
                                            Company Logo<span class="required_field">*</span></label>
                                        <input type="file" name="comp_logo" class="form-control" id="Edit_cLogo" placeholder="Choose an Image">
                                        <i class="fa fa-gg inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 text-center" style="margin-top: 25px;">
                                        <button type="reset" id="EmployeercancelEdit" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="updateEmployeerBtn" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><i class="fa fa-id-card-o" aria-hidden="true"></i> List Of Employer</h4>
                    </div>

                    <div class="box-body">
                        <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                        <table id="employeerTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th data-orderable="false">Sl No.</th>
                                    <th>Company Name</th>
                                    <th>Company Address</th>
                                    <th data-orderable="false">Company Logo</th>
                                    <th data-orderable="false">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Action
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
