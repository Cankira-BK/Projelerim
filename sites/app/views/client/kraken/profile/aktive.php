<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[98]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
					<?php if ($this->aktive == 1):?>					<?=Client::alert('info',$lng[99])?>				<?php else:?>				<?php				Session::init();				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[100]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[101]);					Session::set('cError',false);				}elseif($cError == 'got'){					echo Client::alert('error','Daha önce depo şifresi değiştirme talebinde bulunmuşsunuz. Lütfen mail adresinizi kontrol ediniz.');					Session::set('cError',false);				}elseif($cError == 'OK'){					echo Client::alert('success',$lng[102]);					Session::set('cError',false);				}elseif($cError == 'time'){					$now = date('i');					$residual = Session::get('residual');					$kalan = $now - $residual;					$kalans = 11 - $kalan;					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");					Session::set('cError',false);				}else{					echo Client::alert('info',$lng[103]);				}				?>
                    <form action="<?=URI::get_path('profile/aktivechange')?>" method="POST" autocomplete="off">
                        <div class="bg-light">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="password"><?=$lng[23]?></label>
                                    </td>
                                    <td>
                                        <input type="password" id="password" name="password"placeholder="<?=$lng[23]?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="register-input" for="reCaptcha" style="margin-top: -23px;"><?=$lng[24]?></label>
                                    </td>
                                    <td>
                                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn"><?=$lng[104]?></button>
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
    $("#mailActivationForm").on("submit", function (event) {
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