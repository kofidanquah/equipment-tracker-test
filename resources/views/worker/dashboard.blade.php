@extends('layout.workerStructure')
@section('headerlinks')
    <link rel="stylesheet" href="{{ asset('css/worker/dashboard.css') }}">
@endsection

@section('content')
    <div class="row mb-5">

        {{-- Equipments --}}
        <div class="col-md-4 mb-3">
            <div class="info-card btn btn-warning">
                <div class="info-details ">
                    <i class="fa fa-tools"></i> Equipments
                    <h3>{{ $equipments }}</h3>
                </div>
            </div>
        </div>

        {{-- Pending Maintenace --}}
        <div class="col-md-4 mb-3">
            <div class="info-card btn btn-primary">
                <div class="info-details ">
                    <i class="fa fa-history"></i> Pending Maintenace
                    <h3>{{ $pendingMaintenance }}</h3>
                </div>
            </div>
        </div>

        {{-- Logs --}}
        <div class="col-md-4 mb-3">
            <div class="info-card btn btn-info">
                <div class="info-details ">
                    <i class="fa fa-building"></i> Maintenance<br>
                    <a href="{{ url('myMaintenance') }}"><button type="button" class="btn btn-success mt-2">Record Maintenance</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerlinks')
@endsection
