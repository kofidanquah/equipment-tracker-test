$(document).ready(function() {
    $("#myTable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        ajax: {
            url: "allRoles",
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
                data: "description",
                name: "description",
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
