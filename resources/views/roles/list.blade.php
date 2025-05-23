@extends('layout.adminStructure')
@include('layout.components')
@section('headerlinks')
    <style>
        table {
            width: 100% !important;
        }
    </style>
@endsection
@section('content')
    <div class="text-end mb-3 py-2">
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newRole"><i class="fa fa-plus"></i>
            New</a>
    </div>
    @yield('alertbar')
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    {{-- add role modal --}}
    <div class="modal fade" id="newRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New Role</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <form id="roleForm" class="roleForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="role"> Role Name</label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror"
                                value="{{ old('role') }}" placeholder="Enter role">
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role"> Description (Optional)</label>
                            <textarea rows="3" class="form-control" name="description"></textarea>
                        </div>

                        <div class="text-center">
                            <a class="btn btn-success" onclick="saveRecord('{{ $pg }}')"> Save</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- update role modal --}}
    <div class="modal fade" id="updateRole" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Update Role</h4>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- modal body -->
                <div class="modal-body">
                    <form id="roleForm" class="roleForm">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="role"> Role Name</label>
                            <input type="text" name="role" class="form-control @error('role') is-invalid @enderror"
                                value="{{ old('role') }}" placeholder="Enter role">
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="role"> Description (Optional)</label>
                            <textarea rows="3" class="form-control" name="description"></textarea>
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
    <script src="{{ asset('js/role/pagination.js') }}"></script>
@endsection
