<?php    $ban = $this->password;    $availDt = strtotime($ban['availDt']);    $now = time();    $fark = $availDt - $now;?>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading">
                <h2 class="head"><?=$lng[141]?>
                    <a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a>
                </h2>
            </div>
            <div class="body">
				<?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>					<?=Client::alert('error',$lng[113]); ?>				<?php endif;?>				<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>				<?php				Session::init();				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[115]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[160]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[160]);					Session::set('cError',false);				}elseif($cError == 'wrong'){					echo Client::alert('error',$lng[161]);					Session::set('cError',false);				}elseif($cError == 'length'){					echo Client::alert('error',$lng[128]);					Session::set('cError',false);				}elseif($cError == 'length2'){					echo Client::alert('error',$lng[162]);					Session::set('cError',false);				}elseif($cError == 'same'){					echo Client::alert('error',$lng[163]);					Session::set('cError',false);				}elseif($cError == 'error'){					echo Client::alert('error',$lng[163]);					Session::set('cError',false);				}elseif($cError == 'OK'){					echo Client::alert('success',$lng[164]);					Session::set('cError',false);				}				?>
                    <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="post" accept-charset="utf-8" class="page_form" autocomplete="off">
                        <div class="form-group">
                            <label for="oldPassword" class="col-sm-3 control-label"><?=$lng[165]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="old_password" id="oldPassword" placeholder="<?=$lng[165]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newPassword" class="col-sm-3 control-label"><?=$lng[166]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="new_password" id="newPassword" placeholder="<?=$lng[166]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="rePassword" class="col-sm-3 control-label"><?=$lng[167]?></label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="re_password" id="rePassword" placeholder="<?=$lng[167]?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reCaptcha" class="col-sm-3 control-label"></label>
                            <div class="col-sm-7">
								<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" name="login_submit" class="btn form-btn"><?=$lng[141]?></button>
                            </div>
                        </div>
                    </form>
				<?php endif;?>
            </div>
        </article>
    </div>
</aside>
<script>
    $("#passwordChangeForm").on("submit", function (event) {
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