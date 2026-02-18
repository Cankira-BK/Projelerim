<?php
	if(!isset($_SESSION['id'])) {
		header("Location: ?s=login");
		exit;
	} else {
?>
<div id="container">
	<?php include("pages/etc.php") ?>
	<div id="mainContent">
		<h1>EP Yükleme</h1>
		<div class="dynContent" style="position:relative">
				<font color="#996600;" size="3">
				<br /><p>EP siparişi vermek için
				ücretli bir SMS göndermen gerekiyor.<br />
				SMS metni kullanıcı adın olmalı:
				<?php echo'<b>'.$_SESSION['id'].'</b>'; ?>
				</p><br />
				<table style="text-align: center; width: 385px; border-collapse: collapse; border: 1px solid #996600;" >
					<tbody>
						<tr style="border: 1px solid #996600;">
							<th style="border: 1px solid #996600;">EP</th>
							<th style="border: 1px solid #996600;">SMS numarası</th>
							<th style="border: 1px solid #996600;">Tutar (TRY)</th>
						</tr>
						<tr style="border: 1px solid #996600;">
							<td style="border: 1px solid #996600;">1000</td>
							<td style="border: 1px solid #996600;">06-90-000-001</td>
							<td style="border: 1px solid #996600;">400TL+KDV (508TL)</td>
						</td>
						</tr>
						<tr style="border: 1px solid #996600;">
							<td style="border: 1px solid #996600;">3000</td>
							<td style="border: 1px solid #996600;">06-90-000-002</td>
							<td style="border: 1px solid #996600;">800TL+KDV (1016TL)</td>
						</tr>
						<tr style="border: 1px solid #996600;">
							<td style="border: 1px solid #996600;">9000<br /></td>
							<td style="border: 1px solid #996600;">06-90-000-003</td>
							<td style="border: 1px solid #996600;">1600TL+KDV (2032TL)</td>
						</tr>
						<tr style="border: 1px solid #996600;">
							<td style="border: 1px solid #996600;">25000<br /></td>
							<td style="border: 1px solid #996600;">06-90-000-004</td>
							<td style="border: 1px solid #996600;">4000TL+KDV (5080TL)</td>
						</tr>
					</tbody>
				</table>
				</br><p>Yanlış numaraya veya hatalı kullanıcı adıyla gönderilen </br>SMS'lerden sorumlu değiliz!</p>
			</font>
		</div>
		<div class="endContent"></div>
	</div>
</div>
<?php
	}
?>
