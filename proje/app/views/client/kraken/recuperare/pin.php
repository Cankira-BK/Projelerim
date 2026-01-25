<div class="main-panel panel-download">
	<div class="main-header">
		PIN Unuttum
	</div>
	<div class="main-content">
		<div class="main-inner">
			<div class="content-title"></div>
			<div class="main-text-bg">
				<div class="main-text">
					<?php if (isset($aid)):?>
						<?= Client::alert('error',$lng[74]);?>
					<?php else:?>
						<form action="<?=URI::get_path('recuperare/control3')?>" id="RecuperareNotifyOGs" method="POST" autocomplete="off">
							<div class="bg-light">
								<table>
									<tbody>
                                    <tr>
                                        <td style="width: 150px;">
                                            <label class="register-input" for="register-login"><?=$lng[22]?>:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="login" name="login" placeholder="<?=$lng[22]?>">
                                        </td>
                                    </tr>

									<tr>
										<td style="width: 150px;">
											<label class="register-input" for="register-login"><?=$lng[78]?>:</label>
										</td>
										<td>
											<input type="text" id="email" name="email" placeholder="<?=$lng[78]?>" required>
										</td>
									</tr>

									<tr>
										<td>
											<label class="register-input" for="recaptcha" style="margin-top: -23px;"><?=$lng[24]?></label>
										</td>
										<td>
											<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
										</td>
									</tr>
									</tbody>
								</table>
								<button type="submit" class="btn"><?=$lng[79]?></button>
							</div>
						</form>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
	<div class="main-bottom"></div>
</div>
<script>
    $("#forgetPINForm").on("submit", function (event) {
        event.preventDefault();

        var url = $(this).attr("action");
        var data = $(this).serialize();

        $.ajax({
            url : url,
            type : 'POST',
            data : data,
            dataType : 'json',
            success : function (response) {
                grecaptcha.reset();
                if (response.result)
                    successNotify(response.message);
                else
                    errorNotify(response.message);
            }
        });
    });
</script>