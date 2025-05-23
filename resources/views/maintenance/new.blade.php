@extends('layout.adminStructure')
@include('layout.components')
@section('headerlinks')
@endsection
@section('content')
    <div class="text-end mb-3 py-2">
        <a class="btn btn-success" onclick="saveMaintenance()"><i class="fa fa-file"></i>
            Save</a>
        <a href="{{ route('maintenance.index') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
            Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4 py-3">
                <div class="col-md-6 mb-3">
                    <label>Equipment <span class="text-danger">*</span></label>
                    <select name="equipment" id="equipment" class="form-control">
                        <option selected disabled>--SELECT EQUIPMENT--</option>
                        @foreach ($allEquipments as $equipment)
                            <option value="{{ $equipment->id }}">{{ $equipment->name . ' - ' . $equipment->serial_number }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Assign To <span class="text-danger">*</span></label>
                    <select name="worker" id="worker" class="form-control">
                        <option selected disabled>--SELECT WORKER--</option>
                        @foreach ($allWorkers as $worker)
                            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Maintenance Date <span class="text-danger">*</span></label>
                    <input type="date" name="maintenance_date" id="maintenance_date" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Note</label>
                    <textarea name="note" id="note" class="form-control"></textarea>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footerlinks')
    <script>
        function saveMaintenance() {
            const equipment = $('#equipment').val();
            const worker = $('#worker').val();
            const date = $('#maintenance_date').val();

            if (!equipment || !worker || !maintenance_date) {
                Swal.fire({
                    title: "Oops",
                    text: "Required fields cannot be empty",
                    icon: "warning",
                });
                return
            } else {
                Swal.fire({
                    title: "Save Record",
                    text: "Proceed to save Record?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Yes, save it",
                    cancelButtonText: "Cancel",
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#d33",
                    closeOnConfirm: false,
                }).then(function(result) {
                    if (result.isConfirmed) {
                        $('input[name="_method"]').val("POST");
                        $("#myform").attr("action", "/maintenance");
                        $("#myform").submit();
                    }
                });
            }
        }
    </script>
@endsection
