@extends('layout.adminStructure')
@include('layout.components')
@section('headerlinks')
@endsection
@section('content')
    <div class="text-end mb-3 py-2">
        <a class="btn btn-success" onclick="saveWorker()"><i class="fa fa-file"></i>
            Save</a>
        <a href="{{ route('worker.index') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
            Back</a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row mb-4 py-3">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option selected disabled>--SELECT ROLE--</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('footerlinks')
<script>
    function saveWorker() {
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
            $("#myform").attr("action", "/worker");
            $("#myform").submit();
        }
    });
}
</script>
@endsection
