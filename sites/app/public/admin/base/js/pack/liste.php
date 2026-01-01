<script src="<?=URI::public_path("global/scripts/datatable.js")?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/datatables/datatables.min.js")?>" type="text/javascript"></script>
<script>
    $("#packList").dataTable({
        language: {
            aria: {
                sortAscending: ": activate to sort column ascending",
                sortDescending: ": activate to sort column descending"
            },
            emptyTable: "No data available in table",
            info: "Showing _START_ to _END_ of _TOTAL_ entries",
            infoEmpty: "No entries found",
            infoFiltered: "(filtered1 from _MAX_ total entries)",
            lengthMenu: "_MENU_ entries",
            search: "Search:",
            zeroRecords: "No matching records found"
        },
        buttons: [{extend: "print", className: "btn dark btn-outline"}, {
            extend: "pdf",
            className: "btn green btn-outline"
        }, {extend: "csv", className: "btn purple btn-outline "}],
        scrollY: 500,
        deferRender: !0,
        scroller: !0,
        stateSave: !0,
        order: [[0, "asc"]],
        paging: true,
        lengthMenu: [[10, 15, 20, -1], [10, 15, 20, "All"]],
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
    });

    function packEdit(id) {
        var url = $("#packList").data("control");
        var data = {id:id};
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                if (!response.result)
                    notify('error',response.message);
                else
                {
                    $("#packModal").modal();
                    $('#id').val(response.data.id);
                    $('#name').val(response.data.name);
                    $('#size').val(response.data.size);
                    $('#url').val(response.data.url);
                }
            }
        });
    }

    $("#packEditForm").on("submit",function (event) {
        event.preventDefault();

        var url = $(this).attr('action');
        var data = $(this).serialize();
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                if (!response.result)
                    notify('error',response.message);
                else
                {
                    notify('success',response.message);
                    $("#packModal").modal("hide");
                }
            }
        });
    })
</script>