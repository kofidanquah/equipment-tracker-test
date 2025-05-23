@extends('layout.workerStructure')
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
        <a href="#" class="btn btn-primary"><i class="fa fa-plus"></i> Record Log</a>
    </div>

    @yield('alertbar')
    <table class="table table-bordered" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Equipment</th>
                <th>Status</th>
                <th>Maintenance Date</th>
                <th>Next Maintenance</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <div class="modal fade" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="recordForm" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Record Maintenance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Note</label>
                            <textarea name="note" class="form-control" readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Maintenance Date</label>
                            <input type="date" name="maintenance_date" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label>Next Scheduled Maintenance</label>
                            <input type="date" name="next_maintenance_date" class="form-control" min="{{ Carbon\Carbon::now()->format(('Y-m-d')) }}">
                        </div>
                        <div class="mb-3">
                            <label>Status After Maintenance</label>
                            <select name="status" class="form-control">
                                <option value="1">Completed</option>
                                <option value="2">Escalated</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Remarks<span class="text-danger">*</span></label>
                            <textarea name="remarks" class="form-control"></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="id">
                    <div class="modal-footer">
                        <button type="button" onclick="save()" class="btn btn-success">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('footerlinks')
    <script src="{{ asset('js/maintenance/myPagination.js') }}"></script>
    <script src="{{ asset('js/maintenance/my-maintenance.js') }}"></script>
@endsection
