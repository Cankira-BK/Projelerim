<div id="container">
	<?php include("pages/etc.php") ?>
	<div id="mainContent">
		<h1>Giriş</h1>
		<div class="dynContent">
			<div class="item" id="confirmBox">
				<div class="itemDesc confirmDesc">
					<div class="thumbnailBgSmall"><img src="img/7227be80292ec244a17496ca9b2528.png" width="63px" height="63px" /></div>
					<p>
						<span class="confirmTitle">Giriş</span><br />
						<form action="?s=login" method="post">
							<input type="text" name="user" size="20" required /> « Kullanıcı adı<br />
							<input type="password" name="pw" required /> « Şifre
							<p align="right">
								<input type="submit" name="login" value="Login" />
							</p>
						</form>
						<?php
							if(isset($_POST['login']) && $_POST['login'] == 'Login') {
								$user = mysqli_real_escape_string($sqlServ, $_POST['user']);
								$pw = mysqli_real_escape_string($sqlServ, $_POST['pw']);
								$SQLF = "SELECT * from account.account where login = '$user' and password = PASSWORD('$pw')";
								$check = mysqli_query($sqlServ, $SQLF);
								$num = mysqli_num_rows($check);

								if($num > 0) {
								
									$array = mysqli_fetch_array($check);
									$_SESSION['id'] = $array['login'];
									$_SESSION['acc_id'] = $array['id'];
									$_SESSION['coins'] = $array['coins'];
									$_SESSION['status'] = $array['status'];
									$_SESSION['email'] = $array['email'];
									$_SESSION['real_name'] = $array['real_name'];
									$_SESSION['social_id'] = $array['social_id'];
									
									echo'<meta http-equiv="refresh" content="0; URL=?s=home"> ';
								} else {
									echo '<div class="boxui box-title"></div>
											<div class="boxui box-con">
												<div class="wrap">
													<br /><br /><font color="red"><b>Hatalı kullanıcı adı veya şifre.</b></font><br /><br /><br />
												</div>
											</div>
											<div class="boxui box-end"></div>';
								}
							}
						?>
					</p>
					<br class="clearfloat" />
				</div>
			</div>
		</div>
		<div class="endContent"></div>
	</div>
</div>
