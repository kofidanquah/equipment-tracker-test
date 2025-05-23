$(document).ready(function() {
    $("#myTable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        // scrollX: true,
        ajax: {
            url: "allMaintenance",
            type: "GET",
            data: {}
        },
        columns: [{
                data: "sn",
                name: "sn",
            },
            {
                data: "equipment",
                name: "equipment",
            },
            {
                data: "assigned_to",
                name: "assigned_to",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "maintenance_date",
                name: "maintenance_date",
            },
            {
                data: "next_maintenance",
                name: "next_maintenance",
            },
            {
                data: "action",
                name: "action",
            },
        ],
    });
});
