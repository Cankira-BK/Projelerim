<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"46") == true):?>
    <?php if (\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
        <div class="row">
            <div class="col-md-6 ">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="fa fa-barcode font-green"></i>
                            <span class="caption-subject bold uppercase"> Event Planla</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form_datetime" id="planCreate" role="form" action="<?= URI::get_path('event/plancreate'); ?>" method="post">
                            <div class="form-body">
                                <div class="form-group form-md-line-input form-md-floating-label">
                                    <select class="form-control edited" id="eventName" name="eventName">
                                        <option value="0" selected>Lütfen Event Seçiniz...</option>
										<?php foreach ($this->plan as $row): ?>
                                            <option value="<?= $row['eventFlag'] ?>"><?= $row['name'] ?></option>
										<?php endforeach; ?>
                                    </select>
                                    <label for="form_control_1">Event İsmi Seçiniz.</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form_control_1">Event Başlangıç Zamanı</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' class="form-control" name="startDate"/>
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="form_control_1">Event Bitiş Zamanı</label>
                                <div class='input-group date' id='datetimepicker2'>
                                    <input type='text' class="form-control" name="finishDate"/>
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                 </span>
                                </div>
                            </div>
                            <script type="text/javascript">
                                $(function () {
                                    $('#datetimepicker1').datetimepicker({
                                        format: 'YYYY-MM-DD HH:mm:ss'
                                    });
                                    $('#datetimepicker2').datetimepicker({
                                        format: 'YYYY-MM-DD HH:mm:ss'
                                    });
                                });
                            </script>
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
                $('#planCreate').submit(function (event) {
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
                            if (result.result == 'empty'){
                                notify('error','Lütfen tüm alanları doldurunuz.');
                            }else if(result.result == 'false'){
                                notify('error','Event planı oluşturulamadı.');
                            }else if(result.result == 'got'){
                                notify('error','Bu tarihte zaten event planlanmış');
                            }else if(result.result == 'true'){
                                notify('success','Event başarıyla oluşturuldu.');
                            }
                        },
                        error: function( jqXhr, textStatus, errorThrown ){
                            console.log( errorThrown );
                        }
                    });
                });
            });
        </script>
    <?php else:?>
		<?php
		if(Session::get('changeOK') == true){
			echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
			Session::set('changeOK',false);
		}
		?>
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN SAMPLE FORM PORTLET-->
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="fa fa-barcode font-green"></i>
                            <span class="caption-subject bold uppercase"> Event Planla</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <form class="form_datetime" id="planCreate" role="form" autocomplete="off" action="<?= URI::get_path('event/plancreate2'); ?>" method="post">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="day" class="form-control" id="form_control_1" required>
                                <label for="form_control_1">Gün</label>
                                <span class="help-block">Örn: Pazartesi</span>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="name" class="form-control" id="form_control_1" required>
                                <label for="form_control_1">Event İsmi</label>
                                <span class="help-block">Örn: Ayışığı Define Sandığı</span>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="time" class="form-control" id="form_control_1" required>
                                <label for="form_control_1">Saat</label>
                                <span class="help-block">Örn: 20:00-21:00</span>
                            </div>
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="number" name="owner" class="form-control" id="form_control_1" required>
                                <label for="form_control_1">Sıralama</label>
                                <span class="help-block">Kaçıncı sırada olacağını yazınız. Örn : 1</span>
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
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-green">
                            <i class="fa fa-barcode font-green"></i>
                            <span class="caption-subject bold uppercase"> Event Listesi</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Gün</th>
                                <th>Event İsmi</th>
                                <th>Saat</th>
                                <th>Sıralama</th>
                                <th>İşlem</th>
                            </tr>
                            </thead>
                            <tbody>
							<?php foreach ($this->plan as $row):?>
                                <tr>
                                    <td><?=$row['id'];?></td>
                                    <td><?=$row['day'];?></td>
                                    <td><?=$row['name'];?></td>
                                    <td><?=$row['time']?></td>
                                    <td><?=$row['owner']?></td>
                                    <td><div class="margin-bottom-5 text-center">
                                            <a href="<?=URI::get_path('event/delete2/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        </div
                                    </td>
                                </tr>
							<?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#planCreate').submit(function (event) {
                    event.preventDefault();
                    var data = $(this).serialize();
                    var url = $(this).attr('action');
                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'post',
                        data: data,
                        processData: false,
                        success: function(response){
                            if (!response.result){
                                notify('error',response.message);
                            }else{
                                notify('success',response.message);
                            }
                        }
                    });
                });
            });
        </script>
    <?php endif;?>
<?php endif;?>
