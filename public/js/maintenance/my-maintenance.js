$(document).on('click', '.record-btn', function() {
    const id = $(this).data('id');

    // AJAX request to get the maintenance log data
    $.ajax({
        url: `/maintenance/${id}/data`, // Endpoint to fetch data
        method: 'GET', // HTTP method
        success: function(data) {
            // Set form action (the form action will be used for submitting the record)
            $('#recordForm').attr('action', `/maintenance/${id}/record`);

            // Update the modal title with the equipment name
            $('#recordModal .modal-title').text(`Record Maintenance - ${data.equipment_name}`);

            // Populate the modal fields with the fetched data
            $('input[name="next_maintenance_date"]').val(data.next_maintenance);
            $('textarea[name="note"]').val(data.notes);
            $('input[name="maintenance_date"]').val(data.maintenance_date);
            $('input[name="id"]').val(data.id);

            // Show the modal
            $('#recordModal').modal('show');
        },
        error: function() {
            alert('Failed to fetch maintenance data.');
        }
    });
});

function save() {
    $('input[name="_method"]').val("POST");
    $("#myform").attr("action", "maintenance/record");
    $("#myform").submit();
}