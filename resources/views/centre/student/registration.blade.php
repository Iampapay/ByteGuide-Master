@extends('layout')
@section('title', $title)
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="content-wrapper">
        <section class="content-header">
            <h4>STUDENT REGISTRATION</h4>
            <ol class="breadcrumb">
                <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Registration</li>
                <li class="active"><a href="{{ route('centre.student.view') }}">Student Registration</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <form id="studentRegForm" enctype="multipart/form-data">
                        @csrf
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-file" aria-hidden="true"></i> Basic Details</h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="first_name">First Name<span class="required_field">*</span></label>
                                        <input type="text" name="f_name" class="form-control" id="first_name"
                                            placeholder="First Name">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" name="m_name" class="form-control" id="middle_name"
                                            placeholder="Middle Name">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="last_name">Last Name<span class="required_field">*</span></label>
                                        <input type="text" name="l_name" class="form-control" id="last_name"
                                            placeholder="Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="fatherF_name">Father's First Name<span
                                                class="required_field">*</span></label>
                                        <input type="text" name="fF_name" class="form-control" id="fatherF_name"
                                            placeholder="Father's First Name">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="fatherM_name">Father's Middle Name</label>
                                        <input type="text" name="fM_name" class="form-control" id="fatherM_name"
                                            placeholder="Father's Middle Name">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="fatherL_name">Father's Last Name<span
                                                class="required_field">*</span></label>
                                        <input type="text" name="fL_name" class="form-control" id="fatherL_name"
                                            placeholder="Father's Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="motherF_name">Mother's First Name<span
                                                class="required_field">*</span></label>
                                        <input type="text" name="mF_name" class="form-control" id="motherF_name"
                                            placeholder="Mother's First Name">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="motherM_name">Mother's Middle Name</label>
                                        <input type="text" name="mM_name" class="form-control" id="motherM_name"
                                            placeholder="Mother's Middle Name">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="motherL_name">Mother's Last Name<span
                                                class="required_field">*</span></label>
                                        <input type="text" name="mL_name" class="form-control" id="motherL_name"
                                            placeholder="Mother's Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="guardianF_name">Guardian's First Name</label>
                                        <input type="text" name="gF_name" class="form-control" id="guardianF_name"
                                            placeholder="Guardian's First Name">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="guardianM_name">Guardian's Middle Name</label>
                                        <input type="text" name="gM_name" class="form-control" id="guardianM_name"
                                            placeholder="Guardian's Middle Name">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="guardianL_name">Guardian's Last Name</label>
                                        <input type="text" name="gL_name" class="form-control" id="guardianL_name"
                                            placeholder="Guardian's Last Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="relationW_g">Relationship With Guardian<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" name="rW_guardian" id="relationW_g">
                                            <option value="">~ Select Relationship With Guardian ~</option>
                                            <option value="S/O">S/O</option>
                                            <option value="D/O">D/O</option>
                                            <option value="W/O">W/O</option>
                                            <option value="C/O">C/O</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="gndr">Gender<span class="required_field">*</span></label>
                                        <select class="form-control" name="gender" id="gndr">
                                            <option value="">~ Select Gender ~</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="other">other</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="phyChlng">Physically Challenged<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" name="phy_challenged" id="phyChlng">
                                            <option value="">~ Select ~</option>
                                            <option value="YES">YES</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="dob">Date of Birth<span class="required_field">*</span></label>
                                        <input type="date" name="d_o_b" class="form-control" id="dob"
                                            placeholder="Date of Birth">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="selectCst">Caste<span class="required_field">^</span></label>
                                        <select class="form-control" name="caste" id="selectCst">
                                            <option value="">~ Select Caste ~</option>
                                            <option value="General">General</option>
                                            <option value="SC">SC</option>
                                            <option value="ST">ST</option>
                                            <option value="OBC">OBC</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="rlgn">Religion<span class="required_field">^</span></label>
                                        <select class="form-control" name="religion" id="rlgn">
                                            <option value="">~ Select Religion ~</option>
                                            <option value="HINDU">HINDU</option>
                                            <option value="MUSLIM">MUSLIM</option>
                                            <option value="JAIN">JAIN</option>
                                            <option value="SIKH">SIKH</option>
                                            <option value="BUDDHIST">BUDDHIST</option>
                                            <option value="CHRISTIAN">CHRISTIAN</option>
                                            <option value="OTHERS">OTHERS</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="pbs">Preferred Batch Slot<span
                                                class="required_field">^</span></label>
                                        <select class="form-control" name="prefere_batch" id="pbs">
                                            <option value="">~ Select Batch Slot ~</option>
                                            @foreach ($batchSlot as $bs)
                                                <option value="{{ $bs->id }}">{{ $bs->start_time }} -
                                                    {{ $bs->end_time }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="mrtlStatus">Marital Status<span
                                                class="required_field">^</span></label>
                                        <select class="form-control" name="mar_status" id="mrtlStatus">
                                            <option value="">~ Select Marital Status ~</option>
                                            <option value="SINGLE">SINGLE</option>
                                            <option value="MARRIED">MARRIED</option>
                                            <option value="DIVORCED">DIVORCED</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="panNum">PAN Number</label>
                                        <input type="number" name="pan_num" class="form-control" id="panNum"
                                            placeholder="PAN Number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="voterId">Voter ID</label>
                                        <input type="text" name="voter_id" class="form-control" id="voterId"
                                            placeholder="Voter ID">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="bcn">Birth Certificate No</label>
                                        <input type="text" name="birth_c_no" class="form-control" id="bcn"
                                            placeholder="Birth Certificate No">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="driveL">Driving License No</label>
                                        <input type="text" name="drive_l_no" class="form-control" id="driveL"
                                            placeholder="Driving License">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="xAdmit">Class X Admit Card No</label>
                                        <input type="text" name="x_admit" class="form-control" id="xAdmit"
                                            placeholder="Class X Admit Card No">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="aadhaarNo">Aadhaar Number</label>
                                        <input type="number" name="aadhaar_no" class="form-control" id="aadhaarNo"
                                            placeholder="Aadhaar Number">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="pasportNo">Pasport No</label>
                                        <input type="text" name="pasport_no" class="form-control" id="pasportNo"
                                            placeholder="Pasport No">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="rationNo">Ration Card No</label>
                                        <input type="text" name="ration_no" class="form-control" id="rationNo"
                                            placeholder="Ration Card No">
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="ecoStatus">Economical Status<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" id="ecoStatus" name="eco_status">
                                            <option value="">~ Select Economical Status ~</option>
                                            <option value="APL">APL</option>
                                            <option value="BPL">BPL</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="resStatus">Residential Status<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" id="resStatus" name="res_status">
                                            <option value="">~ Select Residential Status ~</option>
                                            <option value="Residential">Residential</option>
                                            <option value="Non-Residential">Non-Residential</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <label for="karId">Karmadisha ID<span class="required_field">*</span></label>
                                        <input type="text" name="kar_id" class="form-control" id="karId"
                                            placeholder="Karmadisha ID">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-phone-square" aria-hidden="true"></i> Contact
                                        Details</h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="houseNo">House No<span class="required_field">*</span></label>
                                        <input type="text" name="house_no" class="form-control" id="houseNo"
                                            placeholder="House No">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="streetNo">Road/Street No<span class="required_field">*</span></label>
                                        <input type="text" name="street_no" class="form-control" id="streetNo"
                                            placeholder="Road/Street No">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="villTown">Village/Town<span class="required_field">*</span></label>
                                        <input type="text" name="vill_town" class="form-control" id="villTown"
                                            placeholder="Ration Card No">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="state">State<span class="required_field">*</span></label>
                                        <select class="form-control" id="state" name="state">
                                            <option value="">~ Select State ~</option>
                                            @foreach ($state as $s)
                                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="dist">District<span class="required_field">*</span></label>
                                        <select class="form-control" id="dist" name="dist">

                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="block">Block/Municipality<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" id="block" name="block">

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="gramPan">Gram Panchayat</label>
                                        <input type="text" name="gram_pan" class="form-control" id="gramPan"
                                            placeholder="Gram Panchayat">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="post">Post Office<span class="required_field">*</span></label>
                                        <input type="text" name="post_office" class="form-control" id="post"
                                            placeholder="Post Office">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="policeStn">Police Station<span class="required_field">*</span></label>
                                        <input type="text" name="police_stn" class="form-control" id="policeStn"
                                            placeholder="Police Station">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="pinCode">Pin Code<span class="required_field">*</span></label>
                                        <input type="number" name="pin_code" class="form-control" id="pinCode"
                                            placeholder="Pin Code">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="emailId">Email ID</label>
                                        <input type="email" name="email_id" class="form-control" id="emailId"
                                            placeholder="Email ID">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="pMobile">Primary Mobile Number<span
                                                class="required_field">*</span></label>
                                        <input type="number" name="pri_mobile" class="form-control" id="pMobile"
                                            placeholder="Primary Mobile Number">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="secMobile">Secondary Mobile Number</label>
                                        <input type="number" name="sec_mobile" class="form-control" id="secMobile"
                                            placeholder="Secondart Mobile Number">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-university" aria-hidden="true"></i> Educational
                                        & Professional Qualification</h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="eduQlf">Educational Qualification<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" id="eduQlf" name="edu_qualification">
                                            <option value="">~ Select Educational Qualification ~</option>
                                            <option value="VIII">VIII</option>
                                            <option value="XI">XI</option>
                                            <option value="X">X</option>
                                            <option value="XI">XI</option>
                                            <option value="ITI/NTC/NCVT">ITI/NTC/NCVT</option>
                                            <option value="DIPLOMA">DIPLOMA</option>
                                            <option value="ALIM">ALIM</option>
                                            <option value="FAZIL">FAZIL</option>
                                            <option value="KAMIL">KAMIL</option>
                                            <option value="AMIE">AMIE</option>
                                            <option value="PREFERABLY EX-ARMY MEN">PREFERABLY EX-ARMY MEN</option>
                                            <option value="VI">VI</option>
                                            <option value="VII">VII</option>
                                            <option value="10+2">10+2</option>
                                            <option value="M.E/M.Tech">M.E/M.Tech</option>
                                            <option value="WORKSHOP INSTRUCTOR">WORKSHOP INSTRUCTOR</option>
                                            <option value="M.Sc">M.Sc</option>
                                            <option value="B-PHARM">B-PHARM</option>
                                            <option value="MCA">MCA</option>
                                            <option value="MA">MA</option>
                                            <option value="Ph.D">Ph.D</option>
                                            <option value="B.E/B.Tech">B.E/B.Tech</option>
                                            <option value="M-PHARM">M-PHARM</option>
                                            <option value="POST GRADUATE">POST GRADUATE</option>
                                            <option value="MEE">MEE</option>
                                            <option value="MME">MME</option>
                                            <option value="LME">LME</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="eduQlfSts">Educational Qualification Status<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" id="eduQlfSts" name="edu_qlf_status">
                                            <option value="">~ Select Educational Qualification Status ~</option>
                                            <option value="Completed">Completed</option>
                                            <option value="Pursuing">Pursuing</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="empStatus">Employment Status</label>
                                        <select class="form-control" id="empStatus" name="emp_status">
                                            <option value="">~ Select Employment Status ~</option>
                                            <option value="Employed">Employed</option>
                                            <option value="Unemployed">Unemployed</option>
                                            <option value="Retired">Retired</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-bar-chart" aria-hidden="true"></i> Course &
                                        Training Details</h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="trnTyp">Training Type<span class="required_field">*</span></label>
                                        <select class="form-control" id="trnTyp" name="trng_typ">
                                            <option value="">~ Select Training Type ~</option>
                                            <option value="SHORT TERM TRAINING">SHORT TERM TRAINING</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="sector">Sector<span class="required_field">*</span></label>
                                        <select class="form-control" id="sector" name="sector">
                                            <option value="">~ Select Sector ~</option>
                                            <option value="IT">IT</option>
                                            <option value="Construction">Construction</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="course">Course<span class="required_field">*</span></label>
                                        <select class="form-control" id="course" name="course">
                                            <option value="">~ Select Course ~</option>
                                            @foreach ($course as $crs)
                                                <option value="{{ $crs->id }}">{{ $crs->course_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Bank
                                        Details</h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="ifsCode">IFS Code<span class="required_field">*</span></label>
                                        <input type="text" name="ifs_code" class="form-control" id="ifsCode"
                                            placeholder="IFSC Code">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="bankName">Bank Name<span class="required_field">*</span></label>
                                        <input type="text" name="bank_name" class="form-control" id="bankName"
                                            placeholder="Bank Name">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="brnchName">Branch Name<span class="required_field">*</span></label>
                                        <input type="text" name="branch_name" class="form-control" id="brnchName"
                                            placeholder="Branch Name">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="accNum">Account Number<span class="required_field">*</span></label>
                                        <input type="text" name="acc_num" class="form-control" id="accNum"
                                            placeholder="Account Number">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="accHolName">Account Holder's Full Name<span
                                                class="required_field">*</span></label>
                                        <input type="text" name="acc_hold_name" class="form-control" id="accHolName"
                                            placeholder="Account Holder's Full Name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-paperclip" aria-hidden="true"></i> Attachments
                                    </h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="trneePhoto">Trainee Photograph (max upload size 10kb)<span
                                                class="required_field">*</span></label>
                                        <input type="file" name="trainee_photo" class="form-control" id="trneePhoto">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="sign">Signature (max upload size 20kb)<span
                                                class="required_field">*</span></label>
                                        <input type="file" name="signature" class="form-control" id="sign">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="resProof">Residential Proof (max upload size 50kb)<span
                                                class="required_field">*</span></label>
                                        <input type="file" name="res_proof" class="form-control" id="resProof">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="HighQlfProof">Highest Qualification Proof (max upload size 50kb)<span
                                                class="required_field">*</span></label>
                                        <input type="file" name="high_qlf_proof" class="form-control"
                                            id="HighQlfProof">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="ageProof">Age Proof (max upload size 50kb)<span
                                                class="required_field">*</span></label>
                                        <input type="file" name="age_proof" class="form-control" id="ageProof">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="bankPass">Bank Passbook (max upload size 50kb)<span
                                                class="required_field">*</span></label>
                                        <input type="file" name="bank_pass" class="form-control" id="bankPass">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-address-book-o" aria-hidden="true"></i> ID
                                        Proof</h3>
                                </div><br>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="drvLic">Driving License (max upload size 50kb)</label>
                                        <input type="file" name="drv_lic" class="form-control" id="drvLic">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="passProof">Passport (max upload size 50kb)</label>
                                        <input type="file" name="pass_proof" class="form-control" id="passProof">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="rationProof">Ration Card (max upload size 50kb)</label>
                                        <input type="file" name="ration_proof" class="form-control" id="rationProof">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <label for="aadhaarProof">Aadhaar (max upload size 50kb)</label>
                                        <input type="file" name="aadhaar_proof" class="form-control"
                                            id="aadhaarProof">
                                    </div>
                                    <div class="col-xs-4">
                                        <label for="voterProof">Epic | Voter ID (max upload size 50kb)</label>
                                        <input type="file" name="voter_proof" class="form-control" id="voterProof"
                                            placeholder="Bank Name">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success" id="regStudentBtn"><i
                                    class="fa fa-paper-plane"></i> Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <script>
        $('#state').on('change', function() {
            let state_id = $(this).val();
            $('#dist').html('');
            $.ajax({
                url: "{{ url('api/fetch_dist') }}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(respone) {
                    $('#dist').html('<option value="">--Choose District--</option>');
                    $.each(respone.dist, function(index, val) {
                        $('#dist').append('<option value="' + val.id + '">' + val.name +
                            '</option>')
                    })
                }
            });
        });
        $('#dist').on('change', function() {
            let dist_id = $(this).val();
            $('#block').html('');
            $.ajax({
                url: "{{ url('api/fetch_block') }}",
                type: "POST",
                data: {
                    dist_id: dist_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(respone) {
                    $('#block').html('<option value="">--Choose--</option>');
                    $.each(respone.block, function(index, val) {
                        $('#block').append('<option value="' + val.id + '">' + val.name +
                            '</option>')
                    })
                }
            });
        });
    </script>
@endsection
