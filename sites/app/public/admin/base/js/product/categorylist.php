<script src="<?=URI::public_path()?>global/plugins/jquery-nestable/jquery.nestable.js" type="text/javascript"></script>
<script>
    $('.dd').nestable({
        maxDepth: 1
    });

    $('.dd').on('change', function () {
        var type = $(this).data('type');

        if(type === 'main')
        {
            var url = $(this).data('url');
            var data = {data:$(this).nestable('serialize')};

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    notify('error',response.message);
                }
            });
        }
        else
        {
            var url = $("#subMenuList").data('url');
            var data = {id:$(this).data('categoryid'),data:$(this).nestable('serialize')};

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                success: function (response) {
                    notify('error',response.message);
                }
            });
        }
    });

    function subMenuEdit(id,name) {
        $("#subModal").modal();
        $("#subMenuEditID").val(id);
        $("#subMenuEditName").val(name);
    }

    $("#subMenuEditForm").on('submit',function (event) {
        event.preventDefault();
        var url = $(this).attr('action');
        var data = $(this).serialize();

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                if (response.result)
                {
                    $("#"+response.id+"_name").text(response.name);
                    notify('success',response.message);
                }
                else
                    notify('error',response.message);
            }
        });
    });
</script>