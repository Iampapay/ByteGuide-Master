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
        <h1>BATCH SLOT</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li>Placement</li>
            <li class="active"><a href="{{ route('admin.slot.view') }}">Batch Slot</a></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="addBatchSlot">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-clock-o" aria-hidden="true"></i> Batch Slot</h4>
                        </div>
                        <form id="batchSlotForm">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="sTime">Start Time<span class="required_field">*</span></label>
                                        <input type="text" name="start_time" class="form-control" placeholder="hh:mm AM/PM" id="sTime">
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="eTime">
                                            End Time<span class="required_field">*</span></label>
                                        <input type="text" class="form-control" name="end_time" placeholder="hh:mm AM/PM" id="eTime">
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-2 text-center" style="margin-top: 25px;">
                                        <button type="reset" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="addSlotBtn" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="editBatchSlot" style="display: none">
                        <div class="box-header with-border">
                            <h4 class="box-title"><i class="fa fa-registered" aria-hidden="true"></i> Edit Batch Slot</h4>
                        </div>
                        <form id="editslotForm">
                            @csrf
                            <div class="box-body">
                                <input type="hidden" id="u_id" name="update_id" value="">
                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_start_time">Start Time<span class="required_field">*</span></label>
                                        <input type="text" name="update_start_time" class="form-control" id="edit_start_time" placeholder="hh:mm AM/PM">
                                        <i class="fa fa-building inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-5">
                                        <label for="edit_start_time">
                                            End Time<span class="required_field">*</span></label>
                                        <input type="text" name="update_end_time" class="form-control" id="edit_end_time" placeholder="hh:mm AM/PM">
                                        <i class="fa fa-location-arrow inp-inc" aria-hidden="true"></i>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-2 text-center" style="margin-top: 25px;">
                                        <button type="reset" id="Batch-slot-cancelEdit" class="btn btn-danger"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                                        <button type="submit" id="batch_slot_update" class="btn btn-success"><i class="fa fa-paper-plane" aria-hidden="true"></i> Submit</button>
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
                        <table id="batch_slotTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th data-orderable="false">Sl No.</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script>
    $(document).ready(function() {
        $('#sTime').mask('00:00');
    });
</script>
@endsection
