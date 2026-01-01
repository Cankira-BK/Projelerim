<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"39") == true):?>
<div class="row">
    <div class="col-md-6">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <span class="caption-subject bold uppercase"> Hesap Oluştur</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="accountCreate" role="form" action="<?=URI::get_path('account/create');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" name="name" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Adı Soyadı</label>
                            <span class="help-block">Kişinin adı ve soyadı</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" name="login" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Kullanıcı Adı</label>
                            <span class="help-block">Hesap ID</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="password" name="password" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Şifre</label>
                            <span class="help-block">Hesap şifresi</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="email" name="email" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Email Adresi</label>
                            <span class="help-block">Hesap email adresi</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="number" id="ksk" name="ksk" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Karakter Silme Kodu</label>
                            <span class="help-block">Hesap karakter silme kodu</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Oluştur</span>
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
        $('#accountCreate').submit(function (event) {
            event.preventDefault();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            console.log(data);
            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: data,
                processData: false,
                success: function(result){
                    console.log(result.email);
                    if(result.result == "filter"){
                        notify("error","Kayıt gerçekleşmedi. Lütfen bilgileri kontrol ediniz.");
                    }else if(result.result == "empty") {
                        notify("error","Boş alan bırakamazsınız. Lütfen tekrar deneyiniz.");
                    }else if(result.result == "got"){
                        notify("error","Böyle bir kullanıcı mevcut");
                        $('#login').val("");
                    } else if (result.result == true){
                        notify("success","Kayıt oluşturuldu.");
                        $('#name').val("");
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