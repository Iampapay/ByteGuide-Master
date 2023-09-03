@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Trainee Placement Details</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li><a href="{{ route('admin.placement.view') }}">Placement</a></li>
                <li><a href="{{ route('admin.placement.trainee', ['id' => base64_encode($plcem_details->id)]) }}">Trainee Placement</a></li>
                <li><a href="{{ route('admin.batch.view', ['id' => base64_encode($batch_dtls[0]->id), 'Q' => base64_encode($plcem_details->id)]) }}">Assessed Trainee List</a></li>
                <li class="active"><a href="{{ route('admin.placement.traineePlacementDetails', ['id' => base64_encode($student_details->id), 'P' => base64_encode($plcem_details->id)]) }}">Trainee Placement Details</a></li>
                <li ></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-6">
                                <div class="card" style="width: 59rem;">
                                    <div class="card-header bg-primary" style="padding: 10px;">Employeer/Company Details</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Employer Name:</b>  {{ $employer_details->comp_name }} </li>
                                        <li class="list-group-item"><b>Contact No:</b>  -----------</li>
                                        <li class="list-group-item"><b>Email Id:</b>  -----------</li>
                                        <li class="list-group-item"><b>Employer Status:</b>  -----------</li>
                                        <li class="list-group-item"><b>Employer Address:</b>  {{ $employer_details->comp_address }} </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="width: 59rem;">
                                    <div class="card-header bg-primary" style="padding: 10px;">Training Partner Details</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>TP Name:</b>  CINETEQ SERVICES PRIVATE LIMITED</li>
                                        <li class="list-group-item"><b>TP Code:</b>  PBSSD/TP/2022/PUR/4853</li>
                                        <li class="list-group-item"><b>Mobile No:</b>  7364893125</li>
                                        <li class="list-group-item"><b>Email Id:</b>  cineteqservices@gmail.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-6">
                                <div class="card" style="width: 59rem;">
                                    <div class="card-header bg-primary" style="padding: 10px;">Placement Details</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Joining Date:</b>  -----------</li>
                                        <li class="list-group-item"><b>Offered Date:</b>  -----------</li>
                                        <li class="list-group-item"><b>Designation:</b>  {{ $plcem_details->job_title }} </li>
                                        <li class="list-group-item"><b>Job Location:</b>  {{ $plcem_details->job_loc }} </li>
                                        <li class="list-group-item"><b>Provident Fund:</b>  -----------</li>
                                        <li class="list-group-item"><b>ESI Available:</b>  -----------</li>
                                        <li class="list-group-item"><b>Monthly Salary/Income:</b>  -----------</li>
                                        <li class="list-group-item"><b>Employed Sector:</b>  -----------</li>
                                        <li class="list-group-item"><b>Placement Type:</b>  -----------</li>
                                        <li class="list-group-item"><b>Entry Time:</b>  -----------</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="width: 59rem;">
                                    <div class="card-header bg-primary" style="padding: 10px;">Training Centre Details</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>TC Name:</b>  {{ $centre_details->name }} </li>
                                        <li class="list-group-item"><b>TC Code:</b>  -----------</li>
                                        <li class="list-group-item"><b>Mobile No:</b> {{ $centre_details->phone_no }}</li>
                                        <li class="list-group-item"><b>Email Id:</b>  {{ $centre_details->email }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="padding: 20px;">
                            <div class="col-md-6">
                                <div class="card" style="width: 59rem;">
                                    <div class="card-header bg-primary" style="padding: 10px;">Batch Details</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Batch Code:</b>  {{ $batch_dtls[0]->batch_code }} </li>
                                        <li class="list-group-item"><b>Batch Start Date:</b>  -----------</li>
                                        <li class="list-group-item"><b>Batch End Date:</b>  -----------</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card" style="width: 59rem;">
                                    <div class="card-header bg-primary" style="padding: 10px;">Trainee Details</div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><b>Trainee Name: </b>{{ $student_details->s_f_name . ' ' . $student_details->s_m_name . ' ' . $student_details->s_l_name  }}</li>
                                        <li class="list-group-item"><b>trainee Code: </b>-----------</li>
                                        <li class="list-group-item"><b>Mobile No: </b>{{ $student_details->pri_mbl_no }}</li>
                                        <li class="list-group-item"><b>D.O.B: </b>{{ date("d/m/Y", strtotime($student_details->dob)) }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
