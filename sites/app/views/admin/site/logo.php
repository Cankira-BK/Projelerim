<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"74") == true):?>
<?php
$defaultLogoProperties = Themes::defaultLogoProperties(\StaticDatabase\StaticDatabase::settings('client'));
$logoWidth = explode("px",\StaticDatabase\StaticDatabase::settings('logo_width'));
$logoPositionX = explode("px",\StaticDatabase\StaticDatabase::settings('logo_position_x'));
$logoPositionY = explode("px",\StaticDatabase\StaticDatabase::settings('logo_position_y'));
$logoFilter = \StaticDatabase\StaticDatabase::settings('logo_filter');
$logoHover = \StaticDatabase\StaticDatabase::settings('logo_hover');
?>
    <style>
        .logo-header .logo
        {
            display: block;
            margin-right: auto;
            margin-left: auto;
            position: relative;
            width: <?=\StaticDatabase\StaticDatabase::settings('logo_width')?>;
            left: <?=\StaticDatabase\StaticDatabase::settings('logo_position_x')?>;
            right: <?=\StaticDatabase\StaticDatabase::settings('logo_position_y')?>;
            filter: <?=\StaticDatabase\StaticDatabase::settings('logo_filter')?>;
            z-index: 100;
        }

        .logo:hover
        {
            filter: brightness(120%);
        }
    </style>
    <div class="row">
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-image font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Logo Yükleme</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="logoSetting" action="<?=URI::get_path('site/logoupload')?>" class="form-horizontal form-bordered" enctype="multipart/form-data">

                        <!--Current Logo-->
                        <div class="form-group ">
                            <label class="control-label col-md-3">Mevcut Logo</label>
                            <div class="col-md-9">
                                <img id="myLogo" src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" alt="">
                            </div>
                        </div>
                        <!--Current Logo-->

                        <!--Logo Upload-->
                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Logoyu Değiştir</label>
                                <div class="col-md-9">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
                                        <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> Resim Seç </span>
                                                                    <span class="fileinput-exists"> Değiştir </span>
                                                                    <input type="file" name="logo" id="logo" multiple class="file" data-preview-file-type="any"/> </span>
                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Sil </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--Logo Upload-->

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" id="logoButton" class="btn blue">Güncelle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
        <div class="col-md-12 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light form-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-image font-green"></i>
                        <span class="caption-subject font-green sbold uppercase">Logo Ayarları</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form id="logoProperties" action="<?=URI::get_path('site/logoedit')?>" class="form-horizontal form-bordered">

                        <!--Current Logo-->
                        <div class="form-group">
                            <label class="control-label col-md-3">Önizleme</label>
                            <div class="col-md-9">
                                <a href="javascript:void(0)" class="logo-header">
                                    <img id="logoView" src="<?=URL.\StaticDatabase\StaticDatabase::settings('logo')?>" alt="" class="logo">
                                </a>
                            </div>
                        </div>
                        <!--Current Logo-->

                        <!--Logo Settings-->
                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Logo Boyutu</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" name="logo_width" class="form-control" id="logoWidth" value="<?=$logoWidth[0]?>">
                                        <span class="input-group-addon">
                                            PX
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <button type="button" id="logoDefaultWidthButton" class="btn blue">Varsayılan</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Yatay Pozisyon (X Ekseni)</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" name="logo_position_x" class="form-control" id="logoPositionX" value="<?=$logoPositionX[0]?>">
                                        <span class="input-group-addon">
                                            PX
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="logoDefaultPositionXButton" class="btn blue">Varsayılan (Ortala)</button>
                                    [*pozitif ve negatif değerleri alabilir. Örnek : <code>10</code> veya <code>-10</code>]
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Dikey Pozisyon (Y Ekseni)</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="number" name="logo_position_y" class="form-control" id="logoPositionY" value="<?=$logoPositionY[0]?>">
                                        <span class="input-group-addon">
                                            PX
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" id="logoDefaultPositionYButton" class="btn blue">Varsayılan</button>
                                    [*pozitif ve negatif değerleri alabilir. Örnek : <code>10</code> veya <code>-10</code>]
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Filtre</label>
                                <div class="col-md-9">
                                    <input type="hidden" name="logo_filter" class="form-control" id="logoFilter" value="<?=$logoFilter?>">
                                    <button type="button" id="logoDefaultFilterNone" class="btn">Yok</button>
                                    <button type="button" id="logoDefaultFilterShadow" class="btn dark">Shadow</button>
                                    <button type="button" id="logoDefaultFilterBlur" class="btn blue">Blur</button>
                                    <button type="button" id="logoDefaultFilterGrayScale" class="btn green">Gray Scale</button>
                                    <button type="button" id="logoDefaultFilterBrightness" class="btn red">Brightness</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-body">
                            <div class="form-group ">
                                <label class="control-label col-md-3">Hover Efect</label>
                                <div class="col-md-9">
                                    <input type="hidden" name="logo_hover" class="form-control" id="logoHover" value="<?=$logoHover?>">
                                    <button type="button" id="logoDefaultHoverNone" class="btn">Yok</button>
                                    <button type="button" id="logoDefaultHoverShadow" class="btn dark">Shadow</button>
                                    <button type="button" id="logoDefaultHoverBlur" class="btn blue">Blur</button>
                                    <button type="button" id="logoDefaultHoverGrayScale" class="btn green">Gray Scale</button>
                                    <button type="button" id="logoDefaultHoverBrightness" class="btn red">Brightness</button>
                                </div>
                            </div>
                        </div>
                        <!--Logo Settings-->

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" id="logoButton" class="btn blue">Güncelle</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
        </div>
    </div>
    <script>

        //Logo Upload
        $('#logoSetting').submit(function (event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var data = new FormData($(this)[0]);

            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: data,
                cache:false,
                contentType: false,
                processData: false,
                success: function(response)
                {
                    if (response.result)
                    {
                        notify('success',response.message);
                        $('#myLogo').attr('src',"<?=URL?>"+response.data['full_path']);
                    }
                    else
                    {
                        notify('error',response.message);
                    }
                }
            });

        });
        //Logo Upload

        //Logo Width
        $("#logoWidth").bind('keyup input', function(){
            document.getElementById('logoView').style.width = $(this).val()+"px";
        });
        //Logo Width

        //Default Width
        $("#logoDefaultWidthButton").click(function () {
            document.getElementById('logoView').style.width = "<?=$logoWidth[0]?>"+"px";
            document.getElementById('logoWidth').value = "<?=$logoWidth[0]?>";
        });
        //Default Width

        //Logo Position X
        $("#logoPositionX").bind('keyup input', function(){
            document.getElementById('logoView').style.left = $(this).val()+"px";
        });
        //Logo Position X

        //Default Position X
        $("#logoDefaultPositionXButton").click(function () {
            document.getElementById('logoView').style.left = "0px";
            document.getElementById('logoPositionX').value = "0";
        });
        //Default Position X

        //Default Position Y
        $("#logoDefaultPositionYButton").click(function () {
            document.getElementById('logoPositionY').value = "<?=explode("px",$defaultLogoProperties["logo_position_y"])[0]?>";
        });
        //Default Position Y

        //Logo Filter
        //Filter None
        $("#logoDefaultFilterNone").click(function () {
            document.getElementById('logoView').style.filter = "none";
            document.getElementById('logoFilter').value = "none";
        });

        //Filter Shadow
        $("#logoDefaultFilterShadow").click(function () {
            document.getElementById('logoView').style.filter = "drop-shadow(0px 0px 10px rgba(0,0,0,1)) drop-shadow(0px 0px 5px rgba(0,0,0,1))";
            document.getElementById('logoFilter').value = "drop-shadow(0px 0px 10px rgba(0,0,0,1)) drop-shadow(0px 0px 5px rgba(0,0,0,1))";
        });

        //Filter Blur
        $("#logoDefaultFilterBlur").click(function () {
            document.getElementById('logoView').style.filter = "blur(1px)";
            document.getElementById('logoFilter').value = "blur(1px)";
        });

        //Filter GrayScale
        $("#logoDefaultFilterGrayScale").click(function () {
            document.getElementById('logoView').style.filter = "grayscale(40%)";
            document.getElementById('logoFilter').value = "grayscale(40%)";
        });

        //Filter Brightness
        $("#logoDefaultFilterBrightness").click(function () {
            document.getElementById('logoView').style.filter = "brightness(120%)";
            document.getElementById('logoFilter').value = "brightness(120%)";
        });
        //Logo Filter

        //Logo Hover
        //Filter None
        $("#logoDefaultHoverNone").click(function () {
            document.getElementById('logoHover').value = "none";
        });

        //Filter Shadow
        $("#logoDefaultHoverShadow").click(function () {
            document.getElementById('logoHover').value = "drop-shadow(0px 0px 10px rgba(0,0,0,1)) drop-shadow(0px 0px 5px rgba(0,0,0,1))";
        });

        //Filter Blur
        $("#logoDefaultHoverBlur").click(function () {
            document.getElementById('logoHover').value = "blur(1px)";
        });

        //Filter GrayScale
        $("#logoDefaultHoverGrayScale").click(function () {
            document.getElementById('logoHover').value = "grayscale(40%)";
        });

        //Filter Brightness
        $("#logoDefaultHoverBrightness").click(function () {
            document.getElementById('logoHover').value = "brightness(120%)";
        });
        //Logo Hover

        //Logo Properties
        $('#logoProperties').on('submit', function (event) {
            event.preventDefault();
            var url = $(this).attr('action');
            var data = $(this).serialize();

            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: data,
                success: function(response)
                {
                    if (response.result)
                    {
                        notify('success',response.message);
                    }
                    else
                    {
                        notify('error',response.message);
                    }
                }
            });

        });
        //Logo Properties

    </script>
<?php endif;?>

