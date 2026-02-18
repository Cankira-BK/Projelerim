<?php
if (!isset($_SESSION['id'])) {
	header("location: ?s=home");
	exit;
}
?>
<div class="content content-last">
	<div class="content-bg">
		<div class="content-bg-bottom">
			<h2>NUYA2 - Hesap Bilgilerin</h2>
			<div class="administration-inner-content">
				<div class="input-data-box">
					<h4>Detaylar</h4>
					<?php
						// session_start ();
						if(isset($_SESSION['id'])) {
							$coins = $_SESSION['coins'];
							echo "
							<ul>
							<li>Kullanıcı adı: <span class='offset'>" . $_SESSION['id'] . "</span></li>
							<li>Durum: <span class='offset'>" . $_SESSION['status'] . "</span></li>
							<li>Ejderha Parası: <span class='offset'>" . $_SESSION['coins'] . "</span><br /></li>
							<li>Gerçek ad: <span class='offset'>" . $_SESSION['real_name'] . "</span></li>
							<li>E-posta adresin: <span class='offset'>" . $_SESSION['email'] . "</span></li>
							<li>Karakter silme kodu: <strong> " . $_SESSION['social_id'] . " </strong></li>
							</ul>
							";
						}
					?>
					<div class="administration-box">
						<a href="?s=pwchange" class="btn">Bilgileri Değiştir</a>
						<p>Hesabının şifresini veya karakter silme kodunu değiştir.</p>
					</div>
				</div>
				<div class="box-foot"></div>
			</div>
		</div>
	</div>
</div>
<div class="shadow">&nbsp;</div>
