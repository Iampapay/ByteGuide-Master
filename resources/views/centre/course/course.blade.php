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
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h4>Course</h4>
        <ol class="breadcrumb">
            <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li>Course</li>
            <li class="active"><a href="#">Course details</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="addCourse">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-clock-o" aria-hidden="true"></i> Course</h4>
                        </div>
                        <form id="courseForm">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="course_name">Course Name<span class="required_field">*</span></label>
                                        <input type="text" name="course_name" class="form-control" placeholder="Enter Course Name" id="course_name">
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="academic_session_id">
                                            Academic Session Id<span class="required_field">*</span></label>
                                        <input type="text" class="form-control" name="academic_session_id" placeholder="Enter academic session id" id="academic_session_id">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="fees">Fees<span class="required_field">*</span></label>
                                        <input type="text" name="fees" class="form-control" placeholder="Enter Course Name" id="fees">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="fees_advance">Fees Advance<span class="required_field">*</span></label>
                                        <input type="text" name="fees_adv" class="form-control" placeholder="Enter Course Name" id="fees_advance">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="status">Status<span class="required_field">*</span></label>
                                        <input type="text" name="status" class="form-control" placeholder="Enter Course Name" id="status">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-2 text-center" style="margin-top: 25px;">
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="addCourse" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="editCourse" style="display: none">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-registered" aria-hidden="true"></i> Edit Batch</h4>
                        </div>
                        <form id="editCourseForm">
                            @csrf
                            <div class="box-body">
                                <input type="hidden" id="u_id" name="update_id" value="">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_course_name">Course Name<span class="required_field">*</span></label>
                                        <input type="text" name="edit_course_name" class="form-control" placeholder="Enter Course Name" id="edit_course_name">
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_academic_session_id">
                                            Academic session id<span class="required_field">*</span></label>
                                        <input type="text" class="form-control" name="edit_academic_session_id" placeholder="Enter academic session id" id="edit_academic_session_id">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_fees">edit_Fees<span class="required_field">*</span></label>
                                        <input type="text" name="edit_fees" class="form-control" placeholder="Enter Course Name" id="edit_fees">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_fees_advance">Fees Advance<span class="required_field">*</span></label>
                                        <input type="text" name="edit_fees_adv" class="form-control" placeholder="Enter Course Name" id="edit_fees_adv">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_status">edit_Status<span class="required_field">*</span></label>
                                        <input type="text" name="edit_status" class="form-control" placeholder="Enter Course Name" id="edit_status">
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 text-center" style="margin-top: 25px;">
                                        <button type="reset" id="Course-cancelEdit" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="Course_update" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4 class="box-title"><i class="fa fa-id-card-o" aria-hidden="true"></i> List Of Slots</h4>
                    </div>

                    <div class="box-body">
                        <div id="printbar" style="float: right;font-size: 12.8px;"></div>
                        <table id="course_Table" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th data-orderable="false">Sl No.</th>
                                    <th>Course Name</th>
                                    <th>Academic session Id</th>
                                    <th>Fees</th>
                                    <th>Fees Advance</th>
                                    <th>Status</th>
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
