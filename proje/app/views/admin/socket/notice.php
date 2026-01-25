<?php if (\StaticDatabase\StaticDatabase::settings('socket_status') == 0):?>
    <b style="color: darkred">Bu işlemi gerçekleştirebilmem için <a href="<?=URI::get_path('setting/socket')?>">buradan</a> oyununuzun socket bağlantısını gerçekleştirmeniz gerekiyor...</b>
<?php else:?>
<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"55") == true):?>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red">
                    <i class="fa fa-bullhorn font-red"></i>
                    <span class="caption-subject bold uppercase"> Duyuru Geç </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="noticeset" role="form" action="<?=URI::get_path('socket/noticeset');?>" method="post">
                    <div class="form-group form-md-line-input form-md-floating-label">
						<select class="form-control edited" name="type">
							<option value="1">Normal</option>
							<option value="2">Büyük</option>
						</select>
						<label for="type">Duyuru Türü </label>
					</div>
					<div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="notice" name="notice" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Duyuru</label>
                            <span class="help-block">Oyun içi yazmak istediğiniz duyuruyu giriniz...</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn red mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Duyuru Geç</span>
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
        $('#noticeset').submit(function (event) {
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
                    if (result.result == false){
                        notify('error',"Lütfen Bilgileri Kontrol Ediniz!");
                    }else if(result.result == true){
                        notify('success',"Oyundan Duyuru Geçildi!");
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
<?php endif;?>