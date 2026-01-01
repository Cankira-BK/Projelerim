<?php if (\StaticDatabase\StaticDatabase::settings('socket_status') == 0):?>
    <b style="color: darkred">Bu işlemi gerçekleştirebilmem için <a href="<?=URI::get_path('setting/socket')?>">buradan</a> oyununuzun socket bağlantısını gerçekleştirmeniz gerekiyor...</b>
<?php else:?>
<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"56") == true):?>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red">
                    <i class="fa fa-bullhorn font-red"></i>
                    <span class="caption-subject bold uppercase"> Müzik Başlat </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="playset" role="form" action="<?=URI::get_path('socket/playset');?>" method="post">
					<div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="number" id="play" name="play" class="form-control" min="0" max="50" required>
                            <label for="play">Müzik NO</label>
                            <span class="help-block">Açmak istediğiniz müzik numarasını giriniz. Kapatmak için 0 yazınız</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn red mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Başlat</span>
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
        $('#playset').submit(function (event) {
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
                        notify('success',"Oyunda Müzik Başlatıldı!");
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