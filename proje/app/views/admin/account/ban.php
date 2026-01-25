<?php
if (count($this->ban['data']) == 0){
    URI::redirect('errors/index');
    die();
}
$info = $this->ban['data'][0];
if ($info['id'] == 1){
    URI::redirect('errors/index');
    die();
}
?>
<div class="row">
    <div class="col-md-6 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-lock font-dark"></i>
                    <span class="caption-subject bold uppercase"> Sürelİ Ban (<?=$info['login'];?>)</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form_datetime" id="playerBan" role="form" action="<?= URI::get_path('account/banned/'.$info['id']); ?>" method="post">
                    <div class="form-group">
                        <label for="form_control_1">Ban Süresi :</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" name="banDate"/>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ban Nedeni :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="why" required>
							<input type='hidden' class="form-control" name="whoban" value="<?=$getAdmin['login']?>"/>
                            <span class="input-group-addon">
                                                        <i class="fa fa-edit font-dark"></i>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Varsa Ban Kanıt Linki :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="evidence">
                            <span class="input-group-addon">
                                                        <i class="fa fa-adjust font-dark"></i>
                                                    </span>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="<?=$info['id'];?>"/>
                    <script type="text/javascript">
                        $(function () {
                            $('#datetimepicker1').datetimepicker({
                                format: 'YYYY-MM-DD HH:mm:ss'
                            });
                        });
                    </script>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn red btn-block mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Süreli Banla</span>
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
                <div class="caption font-dark">
                    <i class="fa fa-lock font-dark"></i>
                    <span class="caption-subject bold uppercase"> Süresİz Ban (<?=$info['login'];?>)</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form_datetime" id="playerBan2" role="form" action="<?= URI::get_path('account/banned2/'.$info['id']); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ban Nedeni :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="why" required>
							<input type='hidden' class="form-control" name="whoban" value="<?=$getAdmin['login']?>"/>
                            <span class="input-group-addon">
                                                        <i class="fa fa-edit font-dark"></i>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Varsa Ban Kanıt Linki :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="evidence">
                            <span class="input-group-addon">
                                                        <i class="fa fa-adjust font-dark"></i>
                                                    </span>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="<?=$info['id'];?>"/>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <br>
                        <button type="submit" class="btn dark btn-block mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Süresiz Banla</span>
                        </button><br>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-lock font-dark"></i>
                    <span class="caption-subject bold uppercase"> HWID Ban (<?=$info['login'];?>)</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form_datetime" id="playerBan3" role="form" action="<?= URI::get_path('account/banned3/'.$info['id']); ?>" method="post">
                    <div class="form-group">
                        <label for="exampleInputPassword1">Ban Nedeni :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="why" required>
							<input type='hidden' class="form-control" name="whoban" value="<?=$getAdmin['login']?>"/>
                            <span class="input-group-addon">
                                                        <i class="fa fa-edit font-dark"></i>
                                                    </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Varsa Ban Kanıt Linki :</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="evidence">
                            <span class="input-group-addon">
                                                        <i class="fa fa-adjust font-dark"></i>
                                                    </span>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id" value="<?=$info['id'];?>"/>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <br>
                        <button type="submit" class="btn dark btn-block mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">HWID Banla</span>
                        </button><br>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<?php endif;?>
<script>
    $(document).ready(function () {
        $('#playerBan').submit(function (event) {
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
    $(document).ready(function () {
        $('#playerBan2').submit(function (event) {
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
    $(document).ready(function () {
        $('#playerBan3').submit(function (event) {
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