<script src="<?=URI::public_path()?>global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=URI::public_path()?>pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>
<script>
    $("#allList").dataTable({
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
    })
</script>