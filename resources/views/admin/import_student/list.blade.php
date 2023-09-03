@extends('layout')
@section('title', $title)
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Import Excel File</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li>Trainee</li>
            <li class="active"><a href="{{ route('admin.import_student.view') }}">Import Trainee</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="col-md-6">
                                <h4 class="box-title"><i class="fa fa-cloud-download" aria-hidden="true"></i> Import Trainees</h4>
                            </div>
                            <div class="col-md-6 text-right">
                                <a class="btn btn-primary" href="{{ asset('public/sample-Excel/STUDENT_DATA.xlsx') }}" download><i class="fa fa-download" aria-hidden="true"></i> Download Sample</a>
                            </div>
                        </div>
                        <form id="importExcel" enctype="multipart/form-data">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-10">
                                        <label for="import_student">Import Excel File<span class="required_field">*</span></label>
                                        <input type="file" name="import_student" class="form-control" id="import_student">
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-2 text-center" style="margin-top: 25px;">
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="importExcelBtn" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                </div>


            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
@endsection
