$(document).ready(function() {
    $("#myTable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        ajax: {
            url: "allDepartments",
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