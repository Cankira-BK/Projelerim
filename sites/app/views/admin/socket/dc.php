<?php if (\StaticDatabase\StaticDatabase::settings('socket_status') == 0):?>
    <b style="color: darkred">Bu işlemi gerçekleştirebilmem için <a href="<?=URI::get_path('setting/socket')?>">buradan</a> oyununuzun socket bağlantısını gerçekleştirmeniz gerekiyor...</b>
<?php else:?>
<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"53") == true):?>
<div class="row">
    <div class="col-md-6 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red">
                    <i class="fa fa-exclamation font-red"></i>
                    <span class="caption-subject bold uppercase"> DC at (Kullanıcı adı ile)</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="dcSet" role="form" action="<?=URI::get_path('socket/dcset');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="name" name="name" class="form-control" id="form_control_1" required>
                            <input type="hidden" name="stat" value="0">
                            <label for="form_control_1">Kullanıcı Adı</label>
                            <span class="help-block">DC Atmak istediğiniz kullanıcının adını giriniz...</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn red mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Dc At</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
    <div class="col-md-6 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-exclamation font-green"></i>
                    <span class="caption-subject bold uppercase"> DC at (Karakter adı ile)</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="dcSet1" role="form" action="<?=URI::get_path('socket/dcset');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="name" name="name" class="form-control" id="form_control_1" required>
                            <input type="hidden" name="stat" value="1">
                            <label for="form_control_1">Karakter Adı</label>
                            <span class="help-block">DC Atmak istediğiniz karakterin adını giriniz...</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Dc At</span>
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
        $('#dcSet').submit(function (event) {
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
                        notify('success',"Karakter'e Başarıyla DC Attınız.")
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        });
        $('#dcSet1').submit(function (event) {
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
                        notify('success',"Karakter'e Başarıyla DC Attınız.")
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