<div class="main-panel panel-download">
    <div class="main-header">
		<?=$lng[122]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if($this->response['result'] == false): ?>
                        <?php echo Client::alert('error',$lng[81]);?>
                    <?php elseif ($this->response['result'] == true):?>
                    <?php echo Client::alert('info',$lng[135]);?>
                    <form action="<?=URI::get_path('profile/emailchange3')?>" method="POST">
                        <div class="bg-light">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="register-email"><?=$lng[23]?>:</label>
                                    </td>
                                    <td>
                                        <input type="password" id="password" name="password" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="register-email"><?=$lng[133]?>:</label>
                                    </td>
                                    <td>
                                        <input type="email" class="form-control grunge" name="newmail" id="newmail" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="register-email"><?=$lng[134]?>:</label>
                                    </td>
                                    <td>
                                        <input type="email" class="form-control grunge" name="newmail2" id="newmail2" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="register-input" for="register-email" style="margin-top: -23px;"><?=$lng[24]?>:</label>
                                    </td>
                                    <td>
                                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn"><?=$lng[122]?></button>
                        </div>
                    </form>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>