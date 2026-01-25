<script src="<?=URI::public_path("global/scripts/datatable.js")?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/datatables/datatables.min.js")?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js")?>" type="text/javascript"></script>
<script src="<?=URI::public_path("pages/scripts/table-datatables-scroller.min.js")?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/select2/js/select2.full.min.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/plupload/js/plupload.full.min.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/bootstrap-fileinput/bootstrap-fileinput.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/bootstrap-markdown/lib/markdown.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/bootstrap-markdown/js/bootstrap-markdown.js");?>" type="text/javascript"></script>
<script src="<?=URI::public_path("global/plugins/bootstrap-summernote/summernote.min.js");?>" type="text/javascript"></script>
<script>
    $("#newsList").dataTable({
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

    $("#newsContent").summernote({height:300});
    function newsEdit(id) {
        var url = $("#newsList").data("control");
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
                    $("#newsModal").modal();
                    $('#id').val(response.data.id);
                    $('#title').val(response.data.title);
                    $('#image').val(response.data.image);
                    $('#newsContent').summernote('editor.pasteHTML', response.data.content);
                }
            }
        });
    }

    $("#newsEditForm").on("submit",function (event) {
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
                    $("#newsModal").modal("hide");
                    notify('success',response.message);
                }
            }
        });
    })
</script>