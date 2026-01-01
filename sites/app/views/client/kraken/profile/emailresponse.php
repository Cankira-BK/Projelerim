<?php $status = $this->all['result']; ?>
<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[122]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if(!$status): ?>
                        <?= Client::alert('error',$lng[81]);?>
						<?php else:?>
                    <?= Client::alert('info',$lng[135]);?>
                    <form action="<?=URI::get_path('profile/emailchange3')?>" method="POST" autocomplete="off">
                        <div class="bg-light">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="password"><?=$lng[23]?>:</label>
                                    </td>
                                    <td>
                                        <input type="password" id="password" name="password" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="newMail"><?=$lng[133]?>:</label>
                                    </td>
                                    <td>
                                        <input type="email" class="form-control grunge" name="new_mail" id="newMail" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="reMail"><?=$lng[134]?>:</label>
                                    </td>
                                    <td>
                                        <input type="email" class="form-control grunge" name="re_mail" id="reMail" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="register-input" for="reCaptcha" style="margin-top: -23px;"><?=$lng[24]?>:</label>
                                    </td>
                                    <td>
                                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn"><?=$lng[122]?></button>
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
    $("#emailChangeForm2").on("submit", function (event) {
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