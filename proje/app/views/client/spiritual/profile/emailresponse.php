<div class="col-md-9"><div class="col-md-12 no-padding">
        <div class="panel panel-buyuk">
            <div class="panel-heading"><?=$lng[122]?></div>
            <div class="panel-body">
				<?php if($this->response['result'] == false): ?>
					<?php echo Client::alert('error',$lng[81]);?>
				<?php elseif ($this->response['result'] == true):?>
				<?php echo Client::alert('info',$lng[135]);?>
                <form action="<?=URI::get_path('profile/emailchange3')?>" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[23]?></label>
                        <div class="col-sm-6">
                            <input type="password" class="form-control" name="password" id="password" maxlength="30" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[133]?></label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="newmail" id="newmail" maxlength="60" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[134]?></label>
                        <div class="col-sm-6">
                            <input type="email" class="form-control" name="newmail2" id="newmail2" maxlength="60" required autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-3 control-label"><?=$lng[24]?></label>
                        <div class="col-sm-6">
							<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-6">
                            <button type="submit" class="btn btn-giris" style="margin-top: 10px;"> <?=$lng[122]?></button>
                        </div>
                    </div>
                </form>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>