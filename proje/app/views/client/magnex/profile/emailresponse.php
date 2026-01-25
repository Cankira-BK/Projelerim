<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <div class="panel-heading"><h2 class="head"><?=$lng[122]?><a href="<?=URI::get_path('profile')?>" class="back-to-account" title="Geri"></a></h2></div>
            <div class="body">
                <div class="bg-light">
					<?php if($this->response['result'] == false): ?>
						<?php echo Client::alert('error',$lng[81]);?>
					<?php elseif ($this->response['result'] == true):?>
						<?php echo Client::alert('info',$lng[135]);?>
                        <form action="<?=URI::get_path('profile/emailchange3')?>" method="POST" class="page_form" autocomplete="off" >
                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label"><?=$lng[23]?></label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" value="" class="form-control2" placeholder="<?=$lng[23]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label"><?=$lng[133]?></label>
                                <div class="col-sm-12">
                                    <input type="newmail" name="newmail" value="" class="form-control2" placeholder="<?=$lng[133]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="login" class="col-sm-3 control-label"><?=$lng[134]?></label>
                                <div class="col-sm-12">
                                    <input type="newmail2" name="newmail2" value="" class="form-control2" placeholder="<?=$lng[134]?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label"></label>
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
					<?php endif;?>
                </div>
            </div>
        </article>
    </div>
</aside>