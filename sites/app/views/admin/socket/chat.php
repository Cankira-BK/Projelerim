<?php if (\StaticDatabase\StaticDatabase::settings('socket_status') == 0):?>
    <b style="color: darkred">Bu işlemi gerçekleştirebilmem için <a href="<?=URI::get_path('setting/socket')?>">buradan</a> oyununuzun socket bağlantısını gerçekleştirmeniz gerekiyor...</b>
<?php else:?>
<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"54") == true):?>
<div class="row">
    <div class="col-md-6 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red">
                    <i class="fa fa-wechat font-red"></i>
                    <span class="caption-subject bold uppercase"> Chat Ban </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="chatset" role="form" action="<?=URI::get_path('socket/chatset');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="name" name="name" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Karakter Adı</label>
                            <span class="help-block">Chat Ban atmak istediğiniz karakter adını giriniz...</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="time" name="time" class="form-control" id="form_control_1" placeholder="           1 gün = 24h, 2 saat = 1h, 30 dakika = 30m" required>
                            <label for="form_control_1">Süre</label>
                            <span class="help-block">Chat Ban atmak istediğiniz süreyi giriniz...</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn red mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Chat Ban At</span>
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
        $('#chatset').submit(function (event) {
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
                        notify('success',"Karakter'e Chat Ban Atıldı!");
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