<?php
/**
 * download.php — Admin panelden yönetilen indirme linkleri
 *
 * Konum: /public_html/main/download.php
 * Admin:  /public_html/admin/
 */
$adminPath = __DIR__ . '/../admin';
require_once $adminPath . '/config.php';
require_once $adminPath . '/includes/store.php';

$mirrorUrls = array_filter([
    setting_get('client_download_url'),
    setting_get('client_download_url_2'),
    setting_get('client_download_url_3'),
    setting_get('client_download_url_4'),
]);

function safe_url(string $url): string {
    return htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}
?>
<div id="download">
	<div class="content content-last">
		<div class="content-bg">
			<div class="content-bg-bottom">
				<h2>NUYA2 - İndir</h2>
				<div class="download-inner-content">
					<h3>NUYA2'yi şimdi ücretsiz indir!</h3>

					<?php foreach ($mirrorUrls as $url): ?>
					<a href="<?= safe_url($url) ?>" target="_blank" class="download-button-1"
					   onClick="javascript:pageTracker._trackPageview('/downloads/client');"> </a>
					<?php endforeach; ?>

					<br class="clearfloat" />
					<a href="javascript:void(0)" id="requirements">» Sistem Gereksinimleri</a>
					<div id="required">
						<table border="0">
							<caption>Minimum Sistem Gereksinimleri</caption>
							<tbody>
								<tr><td class="left_td">İşletim Sistemi</td><td>- Win XP, Win 2000, Win Vista, Win 7</td></tr>
								<tr><td class="left_td">İşlemci</td><td>- Pentium 3 1GHz</td></tr>
								<tr><td class="left_td">Bellek</td><td>- 512M</td></tr>
								<tr><td class="left_td">Sabit Disk</td><td>- 1 GB</td></tr>
								<tr><td class="left_td">Ekran Kartı</td><td>- 32MB'den fazla RAM'e sahip ekran kartı</td></tr>
								<tr><td class="left_td">Ses Kartı</td><td>- DirectX 9.0 uyumlu</td></tr>
								<tr><td class="left_td">Fare</td><td>- Windows uyumlu fare</td></tr>
							</tbody>
						</table>
						<table border="0">
							<caption>Önerilen Sistem Gereksinimleri</caption>
							<tbody>
								<tr><td class="left_td">İşletim Sistemi</td><td>- Win XP, Win 2000, Win Vista, Win 7</td></tr>
								<tr><td class="left_td">İşlemci</td><td>- Pentium 4 1.8GHz</td></tr>
								<tr><td class="left_td">Bellek</td><td>- 1G</td></tr>
								<tr><td class="left_td">Sabit Disk</td><td>- 2 GB</td></tr>
								<tr><td class="left_td">Ekran Kartı</td><td>- 64MB'den fazla RAM'e sahip ekran kartı</td></tr>
								<tr><td class="left_td">Ses Kartı</td><td>- DirectX 9.0 uyumlu</td></tr>
								<tr><td class="left_td">Fare</td><td>- Windows uyumlu fare</td></tr>
							</tbody>
						</table>
					</div>
					<p id="downloadText">Yetersiz ekran kartı belleği FPS kaybına yol açabilir. Sorunu önlemek için oyun ayarlarını buna göre yapılandır. Aynı anda çok sayıda kullanıcı Client indirirse indirme hızı yavaşlayabilir. Bu durumda sabrın için teşekkür ederiz.</p>

					<script type="text/javascript">
						$(document).ready(function() {
							$('#requirements').click(function(){
								$('#required').slideToggle();
							});
						});
					</script>
					<div class="download-box-foot"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="shadow">&nbsp;</div>
</div>
