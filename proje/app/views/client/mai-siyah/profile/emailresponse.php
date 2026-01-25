<div class="col-md-9 normal-content">
    <div class="row">
        <ol class="breadcrumb grunge">
            <li><a href="<?=URI::get_path('index')?>"><?=$lng[8]?></a></li>
            <li class="active"><?=$lng[122]?></li>
        </ol>
    </div>
    <div class="col-md-12">
		<?php if($this->response['result'] == false): ?>
			<?php echo Client::alert('error',$lng[81]);?>
		<?php elseif ($this->response['result'] == true):?>
			<?php echo Client::alert('info',$lng[135]);?>
            <form action="<?=URI::get_path('profile/emailchange3')?>" method="post" class="form-horizontal">
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[23]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="password" class="form-control grunge" name="password" id="password" required/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[133]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="email" class="form-control grunge" name="newmail" id="newmail" required/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[134]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <input type="email" class="form-control grunge" name="newmail2" id="newmail2" required/>
                        <i class="fa fa-lock form-control-feedback"></i>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <label for="regpassword" class="col-sm-4 control-label"><?=$lng[24]?> <span
                            class="text-danger">*</span></label>

                    <div class="col-sm-5">
                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                    </div>
                </div>
                <div class="row">
                    <div class="form-inline col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-grunge"><?=$lng[122]?></button>
                    </div>
                </div>
            </form>
        <?php endif;?>
    </div>
</div>