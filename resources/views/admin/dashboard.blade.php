@extends('layout.adminStructure')
@section('headerlinks')
    <style>
        .info {
            height: 120px;
            margin-top: 10px;
            text-align: center;
            text-decoration: none;
            padding: 20px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .info-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin: auto;
            height: 120;
            width: 100%;
            padding: 5px;
            cursor: pointer;
        }

        .info-details {
            padding: 20px;
            text-align: center;
        }

        .info-details h3 {
            margin-bottom: 10px;
            font-size: 27px;
        }

        .info-details p {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .bar-container {
            width: 100%;
            height: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .pie-container {
            width: 100%;
            height: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
@endsection
@section('content')
    <div class="row mb-5">

        {{-- Active Workers --}}
        <div class="col-md-4 mb-3">
            <div class="info-card btn btn-warning">
                <div class="info-details ">
                    <i class="fa fa-users"></i> Active Workers
                    <h3>{{ $activeWorkers }}</h3>
                </div>
            </div>
        </div>

        {{-- Equipments --}}
        <div class="col-md-4 mb-3">
            <div class="info-card btn btn-primary">
                <div class="info-details ">
                    <i class="fa fa-tools"></i> Equipments
                    <h3>{{ $equipments }}</h3>
                </div>
            </div>
        </div>

        {{-- Departments --}}
        <div class="col-md-4 mb-3">
            <div class="info-card btn btn-info">
                <div class="info-details ">
                    <i class="fa fa-building"></i> Departments
                    <h3>{{ $departments }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-md-8 mb-3">
            <div class="bar-container">
                <h4 class="text-center">Bar Statistics</h4>
                <canvas id="myDetailedChart"></canvas>
            </div>
        </div>

        <div class="col-md-4">
            <div class="pie-container">
                <h4 class="text-center">Pie Statistics</h4>
                <canvas id="myDetailedPieChart"></canvas>
            </div>
        </div>
    </div>
@endsection
@section('footerlinks')
@endsection
