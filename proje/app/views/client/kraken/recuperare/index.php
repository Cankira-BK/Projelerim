<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[25]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if (isset($aid)):?>					<?php					echo Client::alert('error',$lng[74]);					?>				<?php else:?>				<?php				Session::init();				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[75]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[76]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[76]);					Session::set('cError',false);				} elseif($cError == 'error'){					echo Client::alert('error',$lng[76]);					Session::set('cError',false);				} elseif($cError == 'time'){					$now = date('i');					$residual = Session::get('residual');					$kalan = $now - $residual;					$kalans = 10 - $kalan;					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");					Session::set('cError',false);				} elseif($cError == 'OK'){					echo Client::alert('success',$lng[80]);					Session::set('cError',false);				}				?>
                    <form action="<?=URI::get_path('recuperare/control')?>" id="RecuperareNotifyOGs" method="POST" autocomplete="off">
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
                                    <td>
                                        <label class="register-input" for="register-email"><?=$lng[78]?></label>
                                    </td>
                                    <td>
                                        <input type="text" id="email" name="email" placeholder="<?=$lng[78]?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="register-input" for="register-email" style="margin-top: -23px;"><?=$lng[24]?></label>
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
    $("#forgetPasswordForm").on("submit", function (event) {
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