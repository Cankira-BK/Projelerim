<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"49") == true):?>
<div class="row">
    <div class="col-md-9">
        <!-- BEGIN VALIDATION STATES-->
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Yetkili Oluştur</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form action="<?=URI::get_path('user/create')?>" method="POST" class="form-horizontal" id="userCreate">
                    <div class="form-body">
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-3 control-label" for="form_control_1">Kullanıcı Adı</label>
                            <div class="col-md-9">
                                <input type="text" name="login" class="form-control" placeholder="" required>
                                <div class="form-control-focus"></div>
                                <span class="help-block">Lütfen kullanıcı adı giriniz...</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-3 control-label" for="form_control_1">Şifre</label>
                            <div class="col-md-9">
                                <input type="password" name="password" class="form-control" placeholder="" required>
                                <div class="form-control-focus"></div>
                                <span class="help-block">Lütfen şifre giriniz...</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-3 control-label" for="form_control_1">İp</label>
                            <div class="col-md-9">
                                <input type="text" name="ip" class="form-control" placeholder="" required>
                                <div class="form-control-focus"></div>
                                <span class="help-block">Lütfen kullanıcının ip adresini giriniz...</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-3 control-label" for="form_control_1">İp Açıklaması</label>
                            <div class="col-md-9">
                                <input type="text" name="ipDecription" class="form-control" placeholder="" required>
                                <div class="form-control-focus"></div>
                                <span class="help-block">Lütfen kullanıcının ip açıklamasını giriniz (Ör : oğuzcan pc ip)...</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-3 control-label" for="form_control_1">Kullanıcı İmzası</label>
                            <div class="col-md-9">
                                <input type="text" name="signature" class="form-control" placeholder="" required>
                                <div class="form-control-focus"></div>
                                <span class="help-block">Lütfen kullanıcının imzasını giriniz...</span>
                            </div>
                        </div>
                        <div class="form-group form-md-line-input has-success">
                            <label class="col-md-3 control-label" for="form_control_1">Kullanıcı Yetkisi</label>
                            <div class="col-md-9">
                                <select class="form-control" name="permission">
                                    <option value="0">lütfen Yetki Seçiniz</option>
                                    <option value="99">Admin</option>
                                    <option value="98">Moderatör</option>
                                    <option value="97">Ticket Yetkilisi</option>
                                </select>
                                <div class="form-control-focus"></div>
                                <span class="help-block">Lütfen kullanıcı yetkisi belirleyiniz...</span>
                            </div>
                        </div>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-3 control-label" for="form_control_1">Sayfa Yetkileri</label>
                            <div class="col-md-9">
                                <div class="md-checkbox-list">
                                    <?php foreach ($this->create as $key=>$row):?>
                                    <div class="md-checkbox">
                                        <input type="hidden" name="check-<?=$row['link']?>" class="md-check" value="0">
                                        <input type="checkbox" name="check-<?=$row['link']?>" id="checkbox1_<?=$key+1?>" class="md-check" value="1" >
                                        <label for="checkbox1_<?=$key+1?>">
                                            <span class="inc"></span>
                                            <span class="check"></span>
                                            <span class="box"></span> <?=$row['name']?> </label>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-3 control-label" for="form_control_1">Bölüm Yetkileri</label>
                            <div class="col-md-9">
                                <div class="md-checkbox-list">
                                    <?php foreach (Functions::allPermission() as $keys=>$rows):?>
                                        <input type="text" class="form-control" disabled value="<?=$keys?>">
                                        <br>
                                        <?php foreach ($rows as $key1=>$row1):?>
                                            <div class="md-checkbox">
                                                <input type="hidden" name="permission-<?=$row1?>" class="md-check" value="0">
                                                <input type="checkbox" name="permission-<?=$row1?>" id="checkbox2_<?=$row1?>" class="md-check" value="1" >
                                                <label for="checkbox2_<?=$row1?>">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> <?=$key1?> </label>
                                            </div>
                                        <?php endforeach;?>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">Submit</button>
                                <a href="javascript:;" class="btn default">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- END FORM-->
            </div>
        </div>
        <!-- END VALIDATION STATES-->
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#userCreate').submit(function (event) {
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
                    if (result.result === false){
                        notify('error',result.message);
                    }else if(result.result === true){
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
<?php endif;?>