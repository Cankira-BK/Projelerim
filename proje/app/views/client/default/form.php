<div class="content_wrapper left">
	<div class="real_content">
		<h2 class="headline_news active"><span class="title"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[21]?></span></h2>
		<div class="p4px" style="display: block;">
			<div class="real_content">
				<div class="inner_content news_content">
					<form action="<?=URI::get_path('login/control')?>" id="LoginNotifyOGs" method="post" id="BirForm">
						<table border="0" align="center" width="100%">
							<tbody>
							<tr>
								<td align="center"><label><?=$lng[22]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<input name="login" type="text" value=""></label>
								</td>
							</tr>
							<tr>
							</tr>
							<tr>
								<td align="center"><label><?=$lng[23]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<input name="password" type="password" maxlength="30">
									</label>
								</td>
							</tr>
							<tr>
								<td align="center"><label><?=$lng[24]?> :<span style="color:darkred;text-shadow:none;">*</span><br>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 0) {echo $this->captcha->simple()->call(); echo '<br><input name="captcha" type="password">';}?>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 1) {echo $this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
										<?php if (\StaticDatabase\StaticDatabase::settings('recaptcha') == 2) {echo $this->captcha->hcaptcha(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();}?>
									</label>
								</td>
							</tr>
							<tr>
								<td align="center">
									<br>
									<input type="submit" value="<?=$lng[21]?>">
									<div class="clear"></div>
									<br>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
							</tr>
							</tbody>
						</table>
					</form>
				</div>
			</div>
		</div
	</div>
</div>
</div>