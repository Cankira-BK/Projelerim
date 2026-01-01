<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
<?php
$info = $this->data[0];

?>
<div class="row">
	<div class="col-md-6 ">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light bordered">
			<div class="portlet-title">
				<div class="caption font-dark">
					<i class="fa fa-lock font-dark"></i>
					<span class="caption-subject bold uppercase"> Ep Yükle (<?=$info['login'];?>)</span>
				</div>
			</div>
			<div class="portlet-body form">
				<form class="form_datetime" id="addedep" role="form" action="<?= URI::get_path('account/addedep'); ?>" method="post">
					<div class="form-group">
						<label for="form_control_1">Ep Miktarı :</label>
						<div class='input-group date'>
							<input type='number' class="form-control" name="count"/>
							<input type='hidden' class="form-control" name="id" value="<?=$info['id'];?>"/>
							<span class="input-group-addon">
                                    <span class="glyphicon glyphicon-gift"></span>
                                 </span>
						</div>
					</div>
					<div class="form-actions noborder">
						<!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
						<button type="submit" class="btn red btn-block mt-ladda-btn ladda-button" data-style="contract">
							<span class="ladda-label">Ep Yükle</span>
						</button>
					</div>
				</form>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->
	</div>
</div>
<script>
    $(document).ready(function () {
        $('#addedep').submit(function (event) {
            event.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                success: function(result){
                    console.log(result);
                    if (result.result == false){
                        notify('error',"Bir Hata Oluştu!");
                    }else if(result.result == true){
                        notify('success',"Ep Başarıyla Hesaba Aktarıldı.");
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        });
    });
</script>
<?php endif;?>
