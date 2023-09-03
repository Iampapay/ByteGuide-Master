@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>New Training Centre Registration</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Training Centre</li>
                <li class="active"><a href="{{ route('admin.centre.create') }}">New Training Centre</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="addPlacement">
                            <div class="box-header with-border">
                                <h4 class="box-title"><i class="fa fa-file-text-o" aria-hidden="true"></i> Registration Form</h4>
                            </div>
                            <form id="centreRegForm">
                                @csrf
                                <div class="box-body">
                                    <h4>Basic Details</h4>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="tcnme">Training Centre Name<span class="required_field">*</span></label>
                                            <input type="text" name="centre_name" class="form-control" id="tcnme"
                                                placeholder="Training Centre Name">
                                        </div>
                                    </div>
                                    <h4>Contact Details</h4>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="houseNo">House Premise No.<span class="required_field">*</span></label>
                                            <input type="text" name="house_no" class="form-control" id="houseNo"
                                                placeholder="House Premise No.">
                                        </div><div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="street">Street/Village/Town<span class="required_field">*</span></label>
                                            <input type="text" name="street" class="form-control" id="street"
                                                placeholder="Street/Village/Town">
                                        </div><div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="po">Post Office<span class="required_field">*</span></label>
                                            <input type="text" name="post_office" class="form-control" id="po"
                                                placeholder="Post Office">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="ps">Police Station<span class="required_field">*</span></label>
                                            <input type="text" name="police_station" class="form-control" id="ps"
                                                placeholder="Police Station">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="state">State<span class="required_field">*</span></label>
                                            <input type="text" name="state" class="form-control" id="state"
                                                placeholder="State">
                                        </div><div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="dis">District<span class="required_field">*</span></label>
                                            <input type="text" name="dist" class="form-control" id="dis"
                                                placeholder="District">
                                        </div><div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="block">Block/Municipality<span class="required_field">*</span></label>
                                            <input type="text" name="block" class="form-control" id="block"
                                                placeholder="Block/Municipality">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="pin">Pin Code<span class="required_field">*</span></label>
                                            <input type="number" name="pin_code" class="form-control" id="pin"
                                                placeholder="Pin Code">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="landNo">Landline Number</label>
                                            <input type="text" name="land_no" class="form-control" id="landNo"
                                                placeholder="Landline Number">
                                        </div><div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="mobNo">Mobile Number<span class="required_field">*</span></label>
                                            <input type="number" name="mob_no" class="form-control" id="mobNo"
                                                placeholder="Mobile Number">
                                        </div><div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="faxNo">FAX NO</label>
                                            <input type="text" name="fax_no" class="form-control" id="faxNo"
                                                placeholder="FAX NO">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="eId">Email Id<span class="required_field">*</span></label>
                                            <input type="email" name="email_id" class="form-control" id="eId"
                                                placeholder="Email Id">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="webUrl">Website URL</label>
                                            <input type="text" name="web_url" class="form-control" id="webUrl"
                                                placeholder="Website URL">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="lat">Latitude<span class="required_field">*</span></label>
                                            <input type="text" name="lat" class="form-control" id="lat"
                                                placeholder="Latitude">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="long">Longitude<span class="required_field">*</span></label>
                                            <input type="text" name="long" class="form-control" id="long"
                                                placeholder="Longitude">
                                        </div>
                                    </div>
                                    <h4>SPOC Details</h4>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="spName">SPOC Name<span class="required_field">*</span></label>
                                            <input type="text" name="spos_name" class="form-control" id="spName"
                                                placeholder="SPOC Name">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="spMob">SPOC Mobile<span class="required_field">*</span></label>
                                            <input type="number" name="spos_mob" class="form-control" id="spMob"
                                                placeholder="SPOC Mobile">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-3">
                                            <label for="spEmail">SPOC Email<span class="required_field">*</span></label>
                                            <input type="email" name="spos_email" class="form-control" id="spEmail"
                                                placeholder="SPOC Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-12 col-md-6 col-lg-12 text-right mt-4"><br>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                            <button type="submit" id="addCentreBtn"
                                                class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
