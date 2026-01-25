<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
			<div class="panel-heading"><h2 class="head"><?=$lng[25]?></h2></div>
            <div class="body">
                <div class="error-holder">
                    <div class="container_3 red wide fading-notification" align="left">
						<?php if (isset($aid)):?>					<?php					echo Client::alert('error',$lng[74]);					?>				<?php else:?>				<?php				Session::init();				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[75]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[76]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[76]);					Session::set('cError',false);				} elseif($cError == 'error'){					echo Client::alert('error',$lng[76]);					Session::set('cError',false);				} elseif($cError == 'time'){					$now = date('i');					$residual = Session::get('residual');					$kalan = $now - $residual;					$kalans = 10 - $kalan;					echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");					Session::set('cError',false);				} elseif($cError == 'OK'){					echo Client::alert('success',$lng[80]);					Session::set('cError',false);				}				?>
                    </div>
                </div>
                <form action="<?=URI::get_path('recuperare/control')?>" id="RecuperareNotifyOGs" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
					<div class="form-group">
						<label for="login" class="col-sm-3 control-label"><?=$lng[22]?></label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="login" id="login" placeholder="<?=$lng[22]?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label"><?=$lng[78]?></label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="email" id="email" placeholder="<?=$lng[78]?>">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-6">
							<button type="submit" name="login_submit" class="btn form-btn"><?=$lng[79]?></button>
						</div>
					</div>
                </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
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