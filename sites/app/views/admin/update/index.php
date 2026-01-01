
    <?php
    $captchaStatus = ['0'=>'Pasif','1'=>'Aktif']
    ?>
    <style>
        #versionNote{
            border: 1px solid #ded8d8;
            padding: 15px;
            color: grey;
            display: none;
        }
        #versionNote ul{
            list-style: disc;
        }
        #versionUpdate{
            margin-right: auto;
            margin-left: auto;
            display: block;
        }
    </style>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="fa fa-download font-dark"></i>
                        <span class="caption-subject bold uppercase"> Yazılım Güncellemesi </span>
                    </div>
                </div>
                <b style="display: block;">Mevcut Sürüm : <u style="color: #00a8c6" id="version"><?=\StaticDatabase\StaticDatabase::settings('version')?></u></b><br>
				<div id="loading" style="display: none"><img src="<?=URI::public_path('layouts/layout/img/loading-spinner-blue.gif')?>" alt="" style="margin-right: auto;margin-left: auto;display: block;"></div>
                <div id="versionNotification"></div>
                <div id="versionNote"></div>
                <div class="portlet-body form" id="updateForm">
                    <form id="updateControl" role="form" action="<?=URI::get_path('update/control');?>" method="post">
                            <input type="hidden" name="licence_key" value="<?=\StaticDatabase\StaticDatabase::settings('licence_key')?>">
                            <input type="hidden" name="licence_secret" value="<?=\StaticDatabase\StaticDatabase::settings('licence_secret')?>">
                        <div class="form-actions noborder">
                            <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                            <button id="updateControlButton" type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                                <span class="ladda-label">Güncelleştirmeleri Kontrol Et</span>
                            </button>

                        </div>
                    </form>
                    <form id="updateVersion" role="form" action="<?=URI::get_path('update/download');?>" method="post" style="display: none">
                        <input type="hidden" name="licence_key" value="<?=\StaticDatabase\StaticDatabase::settings('licence_key')?>">
                        <input type="hidden" name="licence_secret" value="<?=\StaticDatabase\StaticDatabase::settings('licence_secret')?>">
                        <div class="form-actions noborder">
                            <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                            <button id="updateControlButton" type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                                <span class="ladda-label">Güncelleştir</span>
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#updateControl').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.post(url,data,function(result){
                document.getElementById('updateControlButton').style.display = "none";
                $('#loading').fadeIn();
                setTimeout(function(){
                    document.getElementById('loading').style.display = "none";
                    if (result.result === false){
                        document.getElementById('versionNotification').innerHTML = '<div class="alert alert-success"> <strong>Sürüm Güncel!</strong> Zaten güncel sürümü kullanıyorsunuz.</div>';
                    }
                    else
                    {
                        document.getElementById('versionNotification').innerHTML = '<div class="alert alert-success"><strong>Güncelleştirme Mevcut </strong><br> Version : '+ result.version +' <br> Yayın Tarihi : '+ result.create_date +'</div>';
                        document.getElementById('versionNote').style.display = "block";
                        document.getElementById('versionNote').innerHTML = result.version_note;
                        document.getElementById('updateVersion').style.display = "block";
                    }
                },2000)
            },"json");
        });
        $('#updateVersion').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();
            $.post(url,data,function(result){
                console.log(result);
                $("#versionNotification").empty();
                document.getElementById('versionNote').style.display = "none";
                document.getElementById('updateForm').style.display = "none";
                if (result.result === false)
                    document.getElementById('versionNotification').innerHTML = '<div class="alert alert-danger"> ' + result.message + '</div>';
                else {
                    $('#loading').fadeIn();
                    setTimeout(function(){
                        document.getElementById('loading').style.display = "none";
                        document.getElementById('versionNotification').innerHTML = '<div class="alert alert-success"> ' + result.message + '</div>';
                        $('#version').text(result.version);
                    },3000);
                }
            },"json");
        });
    </script>

