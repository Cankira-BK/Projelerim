<?php    $ban = $this->aktive;    $availDt = strtotime($ban['availDt']);    $now = time();    $fark = $availDt - $now;?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
             <div class="panel-heading">
                 <h2 class="head"><?=$lng[122]?>
                     <a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a>
                 </h2>
             </div>
            <div class="body">
				<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>					<?=Client::alert('error',$lng[112]); ?>				<?php endif;?>				<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>				<?php if ($this->aktive['mailaktive'] == 1):?>				<?php				$cError = Session::get('cError');						if($cError == 'recaptcha'){							echo Client::alert('error',$lng[115]);							Session::set('cError',false);						}elseif($cError == 'filter'){							echo Client::alert('error',$lng[116]);							Session::set('cError',false);						}elseif($cError == 'error'){							echo Client::alert('error',$lng[116]);							Session::set('cError',false);						}elseif($cError == 'OK'){							echo Client::alert('success',$lng[123]);							Session::set('cError',false);						} elseif($cError == 'OK3'){							echo Client::alert('success',$lng[124]);							Session::set('cError',false);						}elseif($cError == 'time'){							$now = date('i');							$residual = Session::get('residual');							$kalan = $now - $residual;							$kalans = 11 - $kalan;							echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");							Session::set('cError',false);						}else{							echo Client::alert('info',$lng[125]);						}				?>
                <form action="<?=URI::get_path('profile/emailchange2')?>" method="POST" class="page_form" autocomplete="off" >
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-12">
                            <input id="password" type="password" name="password" class="form-control2" placeholder="<?=$lng[23]?>">
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
                            <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[122]?></button>
                        </div>
                    </div>
                </form>
				<?php else:?>				<?php				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[115]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[126]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[126]);					Session::set('cError',false);				}elseif($cError == 'wrong'){					echo Client::alert('error',$lng[127]);					Session::set('cError',false);				}elseif($cError == 'length'){					echo Client::alert('error',$lng[128]);					Session::set('cError',false);				}elseif($cError == 'length2'){					echo Client::alert('error',$lng[129]);					Session::set('cError',false);				}elseif($cError == 'format'){					echo Client::alert('error',$lng[130]);					Session::set('cError',false);				}elseif($cError == 'error'){					echo Client::alert('error',$lng[131]);					Session::set('cError',false);				}elseif($cError == 'OK'){					echo Client::alert('success',$lng[132]);					Session::set('cError',false);				}				?>
                    <form action="<?=URI::get_path('profile/emailchange')?>" method="POST" class="page_form" autocomplete="off" >
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label"><?=$lng[23]?></label>
                            <div class="col-sm-12">
                                <input id="password" type="password" name="password" class="form-control2" placeholder="<?=$lng[23]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newMail" class="col-sm-3 control-label"><?=$lng[133]?></label>
                            <div class="col-sm-12">
                                <input type="email" id="newMail" name="new_mail" class="form-control2" placeholder="<?=$lng[133]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reMail" class="col-sm-3 control-label"><?=$lng[134]?></label>
                            <div class="col-sm-12">
                                <input type="email" id="reMail" name="re_mail" class="form-control2" placeholder="<?=$lng[134]?>">
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
                                <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[122]?></button>
                            </div>
                        </div>
                    </form>
				<?php endif;?>				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#emailChangeForm").on("submit", function (event) {
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