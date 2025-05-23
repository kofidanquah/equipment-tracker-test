$(document).ready(function() {
    $("#myTable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        ajax: {
            url: "allWorkers",
            type: "GET",
            data: {}
        },
        columns: [{
                data: "sn",
                name: "sn",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "role",
                name: "role",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "action",
                name: "action",
            },
        ],
    });
});
