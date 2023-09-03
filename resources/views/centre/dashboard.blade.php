@extends('layout')
@section('title', $title)
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control Panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('centre.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="{{ route('centre.dashboard') }}"> Dashboard</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3>{{ $totalStudent }}</h3>
                            <p>Students</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3>{{ $totalBatch }}</h3>
                            <p>Batches</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-bookmark" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-orange">
                        <div class="inner">
                            <h3>{{ $totalPlacement }}</h3>
                            <p>Placements</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            </div>
        </section>
    </div>

@endsection
