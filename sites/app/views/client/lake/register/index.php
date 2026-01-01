<style>
  .custom-select{
      width: 56%!important;
      margin-right: auto;
      margin-left: auto;
      display: block;
      font-size: 14px;
      color: #fff;
      background: rgb(37, 20, 11);
      border: 1px solid rgba(201, 170, 113, 0.1);
      transition: all 0.3s ease;
      padding: 10px 22px;
      position: relative;
      width: calc(100% - 44px);
  }
</style>
<div class="title">
    <?=$lng[10]?>
</div>
<div class="news page">
	<?php if (\StaticDatabase\StaticDatabase::settings('register_status') == "0"):?>
		<?php echo Client::alert('error','Kayıtlarımız şuanda kapalıdır!');?>
	<?php else:?>
        <form id="registerForm" action="<?=URI::get_path('register/control')?>" method="POST" class="page_form" autocomplete="off">
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="text" class="form-control2" name="login" id="login" required maxlength="16" placeholder="<?=$lng[22]?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control2" name="password" id="registerPassword" placeholder="<?=$lng[23]?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="password" class="form-control2" name="password2" id="registerPassword2" required placeholder="<?=$lng[94]?>"/>
                </div>
            </div>
			<?php if (\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"): ?>
                <div class="form-group">
                    <div class="col-sm-7">
                        <input type="password" class="form-control2" name="pin" id="pin" maxlength="<?=\StaticDatabase\StaticDatabase::systems('pin_adet')?>" onkeypress="return numberOnly(event,this)" placeholder="PIN"/>
                    </div>
                </div>
			<?php endif;?>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="email" class="form-control2" name="email" id="email" required placeholder="<?=$lng[78]?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input id="name" type="text" name="name" class="form-control2" maxlength="30" required placeholder="<?=$lng[95]?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input id="ksk" type="text" name="ksk" class="form-control2" maxlength="7" onkeypress="return numberOnly(event,this)" required placeholder="<?=$lng[96]?>"/>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <input type="text" id="phone" name="phone" class="form-control2" maxlength="10" onkeypress="return numberOnly(event,this)" placeholder="<?=$lng[97]?>"/>
                </div>
            </div>
			<?php if (\StaticDatabase\StaticDatabase::settings('findme_status') === "1"): ?>
			<?php
			$findMeList = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM findme_list");
			$findMeList->execute();
			?>
                <div class="form-group">
                    <div class="col-sm-7">
                        <select id="findme" name="findme" class="custom-select">
                            <option value="0" selected>Bizi nerden buldunuz?</option>
							<?php foreach ($findMeList->fetchAll(PDO::FETCH_ASSOC) as $row):?>
                                <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
							<?php endforeach;?>
                        </select>
                    </div>
                </div>
            <?php endif;?>
            <div class="form-group">
                <div class="col-sm-7">
					<?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-7">
                    <span style="text-align: center;display: block">Kayıt olarak <a href="<?=URI::get_path('privacy')?>" target="_blank">üyelik sözleşmesini</a> kabul ederim.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="login_submit" class="btn form-btn btn-center"><?=$lng[10]?></button>
                </div>
            </div>
        </form>
	<?php endif;?>
</div>
