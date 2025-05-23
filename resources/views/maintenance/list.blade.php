@extends('layout.adminStructure')
@include('layout.components')
@section('headerlinks')
<style>
    table{
        width:100% !important;
    }
</style>
@endsection
@section('content')
<div class="text-end mb-3 py-2">
    <a href="{{ route('maintenance.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New</a>
</div>

@yield('alertbar')
<table class="table table-bordered" id="myTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Equipment</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Maintenance Date</th>
            <th>Next Maintenance</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection
@section('footerlinks')
<script src="{{ asset('js/maintenance/pagination.js') }}"></script>
@endsection
