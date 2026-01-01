<?php    $ban = $this->aktive;    $availDt = strtotime($ban['availDt']);    $now = time();    $fark = $availDt - $now;?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading">
                <h2 class="head"><?=$lng[153]?>
                    <a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a>
                </h2>
            </div>
            <div class="body">
				<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>					<?=Client::alert('error',$lng[112]); ?>				<?php endif;?>				<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>				<?php if ($this->aktive['mailaktive'] == 0):?>					<?=Client::alert('error',$lng[113])?>                    <a href="<?=URI::get_path('profile/aktive')?>" ><button type="submit" class="center-block btn btn-grunge"><?=$lng[98]?></button></a>				<?php else:?>				<?php				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[115]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[101]);					Session::set('cError',false);				}elseif($cError == 'error'){					echo Client::alert('error',$lng[101]);					Session::set('cError',false);				}elseif($cError == 'OK'){					echo Client::alert('success',$lng[154]);					Session::set('cError',false);				}elseif($cError == 'time'){					$now = date('i');					$residual = Session::get('residual');					$kalan = $now - $residual;					$kalans = 11 - $kalan;					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");					Session::set('cError',false);				}else{					echo Client::alert('info',$lng[155]);				}				?>
                    <form action="<?=URI::get_path('profile/kskchange')?>" method="POST" class="page_form" autocomplete="off" >
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-12">
                                <input type="password" class="form-control2" name="password" id="password" required placeholder="<?=$lng[23]?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reCaptcha" class="col-sm-3 control-label"></label>
                            <div class="col-sm-12">
								<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[156]?></button>
                            </div>
                        </div>
                    </form>
				<?php endif;?>				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#kskChangeForm").on("submit", function (event) {
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