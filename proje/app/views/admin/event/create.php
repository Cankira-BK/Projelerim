<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"45") == true):?>
		<?php
		if(Session::get('changeOK') == true){
			echo '<script>$(document).ready(function() {
  notify("success","Event açıldı!");
});</script>';
			Session::set('changeOK',false);
		}
		if(Session::get('changeOK2') == true){
			echo '<script>$(document).ready(function() {
  notify("success","Event kapatıldı!");
});</script>';
			Session::set('changeOK2',false);
		}
		if(Session::get('changeNO') == true){
			echo '<script>$(document).ready(function() {
  notify("warning","Lütfen event seçiniz!");
});</script>';
			Session::set('changeNO',false);
		}
		?>
<div class="row">
    <div class="col-md-12">
        
		<div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-barcode font-green"></i>
                    <span class="caption-subject bold uppercase"> Event Listesi</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="eventCreate2" role="form" action="<?=URI::get_path('event/create');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <select class="form-control edited" name="event_name">
                                <option value="" selected>Event seçimi yapınız...</option>
                                <option value="ayisigi">Ayışığı Etkinliği</option>
                                <option value="futboltopu">Futbol Topu Etkinliği</option>
                                <option value="paskalya">Paskalya Etkinliği</option>
                                <option value="kostum">Kostüm Etkinliği</option>
                                <option value="okey">Okey Etkinliği</option>
                                <option value="sertifika">Sertifika Etkinliği</option>
                                <option value="kuzeykutusu">Kuzey Kutusu Etkinliği</option>
                                <option value="oyma_tas">Oyma Taş Etkinliği</option>
                                <option value="gen_drop">Altıgen Hediye Paketi Etkinliği</option>
                                <option value="pet_event">Yavrucuk Kutusu Etkinliği</option>
                                <option value="beceri_event">Beceri Kitabı Etkinliği</option>
                                <option value="ramazan">Ramazan Simit Etkinliği</option>
                                <option value="hallowen">Cadılar Bayramı Etkinliği</option>
                                <option value="kids_day_quiz">Bulmaca Kutusu Etkinliği</option>
                                <option value="esrarengiz_sandik">Esrarengiz Sandık Etkinliği</option>
                                <option value="gizemli_sandik">Gizemli Sandık Etkinliği</option>
                                <option value="word_event_drop">Kelime Etkinliği</option>
                                <option value="corap">Çorap Etkinliği</option>
                                <option value="donusumkuresi">Dönüşüm Küresi Etkinliği</option>
                                <option value="alignment_event">Derece Etkinliği</option>
                                <option value="defend_and_destroy">Savun ve Yoket Etkinliği</option>
                            </select>
                            <label for="form_control_1">Event Seçiniz</label>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Güncelle</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="icon-settings font-green"></i>
                    <span class="caption-subject bold uppercase">Aktif Eventler</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>Event Adı</th>
                        <th>Event Kodu</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach (Functions::eventList() as $event):?>
						<?php $activeEvent = \StaticGame\StaticGame::sql("SELECT szName FROM ".PLAYER_DB_NAME.".quest WHERE szName = ? AND lValue = 1",[$event]); ?>
                        <?php if (count($activeEvent) > 0):?>
                        <tr>
                            <td><?=Functions::eventListName($event)?></td>
                            <td><?=$event?></td>
                            <td><div class="margin-bottom-5 text-center">
                                    <a href="<?=URI::get_path("event/close/$event")?>" class="btn red mt-ladda-btn ladda-button">
                                        Kapat
                                    </a>
                                </div
                            </td>
                        </tr>
                        <?php endif;?>
					<?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#eventCreate').submit(function (event) {
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
                    if (result === false)
                        notify('error','Hatalı seçim yapmış olabilirsiniz!');
                    else
                        notify('success','Ayarlar güncellendi!');
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    console.log( errorThrown );
                }
            });
        });
    });
</script>
<?php endif;?>
