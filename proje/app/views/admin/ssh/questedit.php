<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"100") == true):?>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="fa fa-lock font-dark"></i>
                    <span class="caption-subject bold uppercase"> Quest Düzenleme İşlemleri</span>
                </div>
            </div>
            <div class="portlet-body form">
				<?php
						$cError = Session::get('cError');
						if($cError == 'basarili'){
							echo Functions::alert_admin('success',"Seçtiğiniz görev başarıyla düzenlenmiştir.");
							Session::set('cError',false);
						}elseif($cError == 'geriyukle'){
							echo Functions::alert_admin('success',"Görev dosyaları orjinal hallerine geri yüklenmiştir.");
							Session::set('cError',false);
						}elseif($cError == 'hata'){
							echo Functions::alert_admin('warning',"İşlem sırasında hata oluştu, tekrar deneyiniz.");
							Session::set('cError',false);
						}elseif($cError == 'ssh2logout'){
							echo Functions::alert_admin('error',"SSH2 Bağlantısı başarısız, şifre hatalı olabilir lütfen kontrol ediniz!");
							Session::set('cError',false);
						}
						?>
                <form role="form" id="freeSellForm" action="<?=URI::get_path('ssh/questedit')?>" method="post" >
					<div class="form-group form-md-line-input form-md-floating-label">
						<select class="form-control edited" name="quest" id="divsecici">
							<option value="">Seçim Yapınız</option>
							<option value="isinlanma_yuzuk">Işınlanma Yüzüğü</option>
							<option value="sebnem_tenturu">Şebnem Tentürü</option>
							<option value="cube">Cube Arındırma</option>
							<option value="oyun_bilgi">Oyuncu Bilgilendirme</option>
							<option value="np_sistem">NP Görevi</option>
						</select>
						<label for="form_control_1">Quest Listesi </label>
					</div>
					<div class="form-group form-md-line-input" id="isinlanma_yuzuk" style="display:none;">
						<label for="form_control_1">Işınlanma Yüzüğü</label>
						<textarea name='isinlanma_yuzuk' cols='125' rows='25'><?php echo "".SSHConnect::fileReadSTFP("data/quest/isinlanma_yuzuk.lua")."";?></textarea>
					</div>
					<div class="form-group form-md-line-input" id="sebnem_tenturu" style="display:none;">
						<label for="form_control_1">Şebnem Tentürü</label>
						<textarea name='sebnem_tenturu' cols='125' rows='25'><?php echo "".SSHConnect::fileReadSTFP("data/quest/sebnem_tenturu.lua")."";?></textarea>
					</div>
					<div class="form-group form-md-line-input" id="cube" style="display:none;">
						<label for="form_control_1">Cube Arındırma</label>
						<textarea name='cube' cols='125' rows='25'><?php echo "".SSHConnect::fileReadSTFP("data/quest/cube.lua")."";?></textarea>
					</div>
					<div class="form-group form-md-line-input" id="oyun_bilgi" style="display:none;">
						<label for="form_control_1">Oyuncu Bilgilendirme</label>
						<textarea name='oyun_bilgi' cols='125' rows='25'><?php echo "".SSHConnect::fileReadSTFP("data/quest/oyun_bilgi.lua")."";?></textarea>
					</div>
					<div class="form-group form-md-line-input" id="np_sistem" style="display:none;">
						<label for="form_control_1">NP Görevi</label>
						<textarea name='np_sistem' cols='125' rows='25'><?php echo "".SSHConnect::fileReadSTFP("data/quest/np_sistem.lua")."";?></textarea>
					</div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn dark btn-block mt-ladda-btn ladda-button" name="action" value="1">
                            <span class="ladda-label">Kaydet</span>
                        </button><br>
						<button type="submit" class="btn dark btn-block mt-ladda-btn ladda-button" name="action" value="2">
                            <span class="ladda-label">Geri Yükle</span>
                        </button><br>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  var x = document.getElementById("divsecici").value;
  $.divliste = {
    '0' : $([]),
    'isinlanma_yuzuk' : $('#isinlanma_yuzuk'),
    'sebnem_tenturu' : $('#sebnem_tenturu'),
    'cube' : $('#cube'),
    'oyun_bilgi' : $('#oyun_bilgi'),
    'np_sistem' : $('#np_sistem')
  };
 
  $('#divsecici').change(function() {
    // hide all
    $.each($.divliste, function() { this.hide(); });
    // show current
    $.divliste[$(this).val()].show();
  });
});
 
</script>
<?php endif;?>