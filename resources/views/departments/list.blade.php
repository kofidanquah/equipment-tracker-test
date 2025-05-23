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
    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newDepartment"><i class="fa fa-plus"></i>
        New</a>
    </div>
    @yield('alertbar')
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    {{-- add department modal --}}
    <div class="modal fade" id="newDepartment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Department</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <form id="departmentForm" class="departmentForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="department"> Department Name</label>
                            <input type="text" name="department" class="form-control @error('department') is-invalid @enderror"
                                value="{{ old('department') }}" placeholder="Enter department">
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <a class="btn btn-success" onclick="saveRecord('{{ $pg }}')"> Save</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- update department modal --}}
    <div class="modal fade" id="updateDepartment" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Department</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <form id="departmentForm" class="departmentForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="department"> Department Name</label>
                            <input type="text" name="department" class="form-control @error('department') is-invalid @enderror"
                                value="{{ old('department') }}" placeholder="Enter department">
                            @error('department')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <a class="btn btn-success" onclick="saveRecord('{{ $pg }}')"> Save</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footerlinks')
<script src="{{ asset('js/departments/pagination.js') }}"></script>
@endsection
