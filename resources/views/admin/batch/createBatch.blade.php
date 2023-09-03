@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Create Batch</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dasboard') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
                <li>Batch</li>
                <li class="active">Create Batch</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            {{-- <h3 class="box-title">Search Filters All fields are mandetory</h3> --}}
                            <h3 class="box-title">Search Filters <small style="color: red">All fields are mandatory</small>
                            </h3>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session('error') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('user-manage') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-xs-2">
                                        <select class="form-control" name="rW_guardian" id="relationW_g">
                                            <option value="">~ Select Training Type ~</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                        </select>
                                        @if ($errors->has('rW_guardian'))
                                            <span class="error">{{ $errors->first('rW_guardian') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-xs-3">
                                        <select class="form-control" name="gender" id="gndr">
                                            <option value="">~ Select Course ~</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="error">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-xs-2">
                                        <select class="form-control" name="gender" id="gndr">
                                            <option value="">~ Select Training Hours ~</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="error">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-xs-3">
                                        <select class="form-control" name="gender" id="gndr">
                                            <option value="">~ Select Training Days Per Week ~</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="error">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div>
                                </div>


                                {{-- <div class="form-group row @if ($errors->has('name')) has-error @endif">
                                    <div class="col-xs-12">
                                        <label for="sDate">Start Date<span class="required_field">*</span></label>
                                        <input type="date" name="StartDate" class="form-control" value="{{ old('StartDate') }}">
                                        @if ($errors->has('StartDate'))
                                            <span class="error">{{ $errors->first('StartDate') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-xs-12">
                                       <label for="wDay">Select Weekly Day<span class="required_field">*</span></label>
                                        @if ($errors->has('weeklyDay'))
                                        <br>
                                       <span class="error">{{$errors->first('weeklyDay')}}</span>
                                       @endif
                                       <div class="form-group">
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Monday">&nbsp;
                                          <label>Monday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Tuesday">&nbsp;
                                          <label>Tuesday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Wednesday">&nbsp;
                                          <label>Wednesday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Thursday">&nbsp;
                                          <label>Thursday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Friday">&nbsp;
                                          <label>Friday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Saturday">&nbsp;
                                          <label>Saturday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Sunday">&nbsp;
                                          <label>Sunday</label>
                                       </div>
                                    </div>
                                 </div> --}}

                                {{-- <div class="form-group-row">
                                    <div class="col-xs-12">
                                        <label>Multi-select</label>
                                        @if ($errors->has('weeklyDay'))
                                        <br>
                                        <span class="error">{{$errors->first('weeklyDay')}}</span>
                                        @endif
                                       <div class="form-group">
                                        <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                                            <option value="AL">Alabama</option>
                                              ...
                                            <option value="WY">Wyoming</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div> --}}

                                {{-- <div class="form-group row @if ($errors->has('startTime')) has-error @endif">
                                    <div class="col-xs-12">
                                        <label for="sFrom">Start From<span class="required_field">*</span></label>
                                        <input type="time" name="startTime" class="form-control"
                                            value="{{ old('startTime') }}">
                                        @if ($errors->has('startTime'))
                                            <span class="error">{{ $errors->first('startTime') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row @if ($errors->has('endTime')) has-error @endif">
                                    <div class="col-xs-12">
                                        <label for="eTo">End To<span class="required_field">*</span></label>
                                        <input type="time" name="phone_no" class="form-control"
                                            value="{{ old('endTime') }}">
                                        @if ($errors->has('endTime'))
                                            <span class="error">{{ $errors->first('endTime') }}</span>
                                        @endif
                                    </div>
                                </div> --}}

                            </div>
                            {{-- <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div> --}}
                        </form>

                        <div class="box-header with-border">
                            {{-- <h3 class="box-title">Search Filters All fields are mandetory</h3> --}}
                            <h3 class="box-title">SELECT BATCH SCHEDULES</h3>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session('error') }}
                                </div>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ url('user-manage') }}" method="POST">
                            @csrf
                            <div class="box-body">
                                <div class="form-group row @if ($errors->has('name')) has-error @endif">
                                    <div class="col-xs-4">
                                        <label for="sDate">Start Date<span class="required_field">*</span></label>
                                        <input type="date" name="StartDate" class="form-control"
                                            value="{{ old('StartDate') }}">
                                        @if ($errors->has('StartDate'))
                                            <span class="error">{{ $errors->first('StartDate') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="sDate">End Date<span class="required_field">*</span></label>
                                        <input type="date" name="StartDate" class="form-control"
                                            value="{{ old('StartDate') }}">
                                        @if ($errors->has('StartDate'))
                                            <span class="error">{{ $errors->first('StartDate') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="sDate">Start Time (24 Hrs Format)<span
                                                class="required_field">*</span></label>
                                        <input type="time" name="StartDate" class="form-control"
                                            value="{{ old('StartDate') }}">
                                        @if ($errors->has('StartDate'))
                                            <span class="error">{{ $errors->first('StartDate') }}</span>
                                        @endif
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <div class="col-xs-12">
                                       <label for="wDay">Select Weekly Day<span class="required_field">*</span></label>
                                        @if ($errors->has('weeklyDay'))
                                        <br>
                                       <span class="error">{{$errors->first('weeklyDay')}}</span>
                                       @endif
                                       <div class="form-group">
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Monday">&nbsp;
                                          <label>Monday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Tuesday">&nbsp;
                                          <label>Tuesday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Wednesday">&nbsp;
                                          <label>Wednesday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Thursday">&nbsp;
                                          <label>Thursday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Friday">&nbsp;
                                          <label>Friday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Saturday">&nbsp;
                                          <label>Saturday</label>
                                          <input type="checkbox" class="minimal" name="weeklyDay" value="Sunday">&nbsp;
                                          <label>Sunday</label>
                                       </div>
                                    </div>
                                 </div> --}}

                                {{-- <div class="form-group-row">
                                    <div class="col-xs-12">
                                        <label>Multi-select</label>
                                        @if ($errors->has('weeklyDay'))
                                        <br>
                                        <span class="error">{{$errors->first('weeklyDay')}}</span>
                                        @endif
                                       <div class="form-group">
                                        <select class="js-example-basic-multiple" name="states[]" multiple="multiple">
                                            <option value="AL">Alabama</option>
                                              ...
                                            <option value="WY">Wyoming</option>
                                          </select>
                                       </div>
                                    </div>
                                 </div> --}}

                                <div class="form-group row @if ($errors->has('startTime')) has-error @endif">
                                    <div class="col-xs-4">
                                        <label for="sFrom">Assessment Request Date<span
                                                class="required_field">*</span></label>
                                        <input type="date" name="startTime" class="form-control"
                                            value="{{ old('startTime') }}">
                                        @if ($errors->has('startTime'))
                                            <span class="error">{{ $errors->first('startTime') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="eTo">Assessment Request Time<span
                                                class="required_field">*</span></label>
                                        <select class="form-control" name="gender" id="gndr">
                                            <option value=""> Select Slot</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                            <option value="#">#</option>
                                        </select>
                                        @if ($errors->has('gender'))
                                            <span class="error">{{ $errors->first('gender') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-xs-4">
                                        <label for="eTo">End Time (24 Hrs Format)<span
                                                class="required_field">*</span></label>
                                        <input type="time" name="phone_no" class="form-control"
                                            value="{{ old('endTime') }}">
                                        @if ($errors->has('endTime'))
                                            <span class="error">{{ $errors->first('endTime') }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </form>

                        <div class="box-header with-border">
                            {{-- <h3 class="box-title">Search Filters All fields are mandetory</h3> --}}
                            <h3 class="box-title">SELECT APPLICANTS TO CREATE BATCH</h3>
                            @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    {{ Session('error') }}
                                </div>
                            @endif
                        </div>

                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 style="color: red">Only Biometric register candidates will be listed bellow 0 no of trainee selected</h6>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-right" style="color: red">0 no of trainee selected</h6>
                                </div>
                            </div>
                            <table id="example" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Mark</th>
                                        <th>Trainee ID</th>
                                        <th>Trainee Name</th>
                                        <th>Gender</th>
                                        <th>e-mail</th>
                                        <th>Contact No</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> <input type="checkbox"> </td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                        <td>Lorem ipsum dolor sit amet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
