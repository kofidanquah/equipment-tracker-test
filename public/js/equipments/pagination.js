$(document).ready(function() {
    $("#myTable").DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        scrollX: true,
        ajax: {
            url: "allEquipments",
            type: "GET",
            data: {}
        },
        columns: [{
                data: "sn",
                name: "sn",
            },
            {
                data: "image",
                name: "image",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "department",
                name: "department",
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