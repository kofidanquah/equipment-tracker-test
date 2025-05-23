@extends('layout.adminStructure')
@include('layout.components')
@section('headerlinks')
    <style>
        #imagePreview{
            width:300px;
            height:200px;
            display: none;
        }
    </style>
@endsection
@section('content')
    <div class="text-end mb-3 py-2">
        <a class="btn btn-success" onclick="saveEquipment()"><i class="fa fa-file"></i>
            Save</a>
        <a href="{{ route('equipment.index') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
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
                    <label>Serial Number</label>
                    <input type="text" name="serial_number" id="serial_number" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Date Purchased</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Department</label>
                    <select name="department" class="form-control">
                        <option selected disabled>--SELECT DEPARTMENT--</option>
                        @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Equipment Image</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*"
                        onchange="previewImage(event)">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Preview</label><br>
                    <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail">
                </div>

            </div>
        </div>
    </div>
@endsection
@section('footerlinks')
    <script>
        function saveEquipment() {
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
                    $("#myform").attr("action", "/equipment");
                    $("#myform").submit();
                }
            });
        }


        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
