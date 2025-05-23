function saveRecord(page) {
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
            $("#myform").attr("action", page);
            $("#myform").submit();
        }
    });
}

// edit record
function editRecord(page, id) {
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
            $('input[name="_method"]').val("PATCH");
            $("#myform").attr("action", page + id);
            $("#myform").submit();
        }
    });
}

// confirm delete
function deleteRecord(page, id) {
    Swal.fire({
        title: "Delete Record",
        text: "Proceed to delete Record?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Yes, Delete it",
        cancelButtonText: "Cancel",
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        closeOnConfirm: false,
    }).then(function(result) {
        if (result.isConfirmed) {
            $('input[name="_method"]').val("DELETE");
            $("#myform").attr("action", page + "/" + id);
            $("#myform").submit();
        }
    });
}