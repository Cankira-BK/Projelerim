<?php
$profile = $this->profile;
function getPermission($value)
{
    if ($value == 98){
        return 'Moderatör';
    }elseif($value == 99){
        return 'Admin';
    }
}
?>
<div class="row">
    <div class="col-md-9">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Hesap Yönetimi</span>
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 30px;">
                <label class="col-md-2 control-label">Profile Resmi:
                </label>
                <div class="col-md-10">
                    <img id="myItem" src="<?=URL.$profile['avatar']?>" alt="">
                    <a class="btn red btn-circle btn-outline sbold" data-toggle="modal" href="#responsive"><i class="fa fa-image"></i> Değiştir </a>
                </div>
            </div>
            <div class="portlet-body form">
                <form role="form" id="profileChange" method="post" action="<?=URI::get_path('profile/change')?>">
                    <div class="form-body">
                        <div class="form-group form-md-line-input">
                            <input type="text" disabled class="form-control" id="form_control_1" placeholder="<?=$profile['login']?>">
                            <label for="form_control_1">Kullanıcı Adı</label>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <input type="text" class="form-control" name="name" id="form_control_1" value="<?=$profile['name']?>">
                            <label for="form_control_1">İsim</label>
                        </div>
                        <div class="form-group form-md-line-input">
                            <label for="form_control_1">İmza</label>
                            <textarea class="input-block-level" id="summernote_1" name="signature" rows="18"><?=$profile['imza']?></textarea>
                        </div>
                        <div class="form-group form-md-line-input">
                            <input type="text" disabled class="form-control" id="form_control_1" placeholder="<?=getPermission($profile['permission'])?>">
                            <label for="form_control_1">Yetki</label>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn blue">Güncelle</button>
                        <a class=" btn blue pull-right" data-target="#stack1" data-toggle="modal"> Şifre Değiştir </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="stack1" class="modal fade" tabindex="-1" data-width="400">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?=URI::get_path('profile/password')?>" id="passwordChange" method="POST">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Şifre Değiştir</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                            <input type="password" name="oldPass" class="col-md-12 form-control" placeholder="Mevcut Şifre"><br>
                        <p>
                            <input type="password" name="newPass" class="col-md-12 form-control" placeholder="Yeni Şifre"><br>
                        </p>
                        <p>
                            <input type="password" name="reNewPass" class="col-md-12 form-control" placeholder="Tekrar Yeni Şifre"> <br>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn dark btn-outline">Kapat</button>
                <button type="submit" class="btn red">Güncelle</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div id="responsive" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" style="width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Profil Resmini Değiştir</h4>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form id="logoSetting" action="<?=URI::get_path('profile/imageupload/'.$profile['id']);?>" class="form-horizontal form-bordered" enctype="multipart/form-data">
                                <div class="form-body" style="margin-left: 15px;">
                                    <div class="form-group ">
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                                <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Resim Seç </span>
                                                                    <span class="fileinput-exists"> Değiştir </span>
                                                                    <input type="file" name="logo" id="logo" multiple class="file" data-preview-file-type="any"/> </span>
                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Sil </a>
                                                    <button id="imgUpload" class="btn green fileinput-exists" > Yükle </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#imgUpload').click(function (eve) {
        eve.preventDefault();
        var url = $('#logoSetting').attr('action');
        var data = new FormData($('#logoSetting')[0]);
        var base_url = window.location.origin;
        var pathArray = window.location.pathname.split( '/' );
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                if(result.result == false){
                    if(result.message == 'empty'){
                        notify('error',"İlk önce eşyayı kayıt edin");
                    }else if(result.message == 'error'){
                        notify('error',"Başka bir resim kullanın");
                    }
                }else if(result.result == true){
                    notify('success',"Profile Resmi Güncellendi");
                    var paths = window.location.pathname;
                    var protocol = window.location.protocol;
                    var host = window.location.host;
                    var path = paths.split('/')[1];
                    document.getElementById('myItem').src = protocol+'//'+host+'/'+path+'/'+result.message
                }
            }
        });
    });
    $(document).ready(function () {
        $('#passwordChange').submit(function (event) {
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
                    if(result.result == false){
                        notify('error',result.message);
                    }else if(result.result == true){
                        notify('success',result.message);
                        $('#stack1').modal('hide');
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        });
    });
    $(document).ready(function () {
        $('#profileChange').submit(function (event) {
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
                    if(result.result == false){
                        notify('error',result.message);
                    }else if(result.result == true){
                        notify('success',result.message);
                    }
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        });
    });
</script>