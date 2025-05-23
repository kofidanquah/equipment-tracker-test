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
        <a href="{{ route('equipment.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i>
            New</a>
    </div>
    @yield('alertbar')
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Department</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
@section('footerlinks')
    <script src="{{ asset('js/equipments/pagination.js') }}"></script>
@endsection
