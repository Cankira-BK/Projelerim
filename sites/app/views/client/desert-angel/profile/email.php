<?php
    $ban = $this->aktive;
    $availDt = strtotime($ban['availDt']);
    $now = time();
    $fark = $availDt - $now;

?>
<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[122]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>
                        <?=Client::alert('error',$lng[112]); ?>
                    <?php endif;?>
                    <?php if ($ban['status'] == 'OK' && $availDt <= $now):?>
                    <?php if ($this->aktive['mailaktive'] == 1):?>
                    <?php
                        $cError = Session::get('cError');
                        if($cError == 'recaptcha'){
                            echo Client::alert('error',$lng[115]);
                            Session::set('cError',false);
                        }elseif($cError == 'filter'){
                            echo Client::alert('error',$lng[116]);
                            Session::set('cError',false);
                        }elseif($cError == 'error'){
                            echo Client::alert('error',$lng[116]);
                            Session::set('cError',false);
                        }elseif($cError == 'OK'){
                            echo Client::alert('success',$lng[124]);
                            Session::set('cError',false);
                        } elseif($cError == 'OK3'){
                            echo Client::alert('success',$lng[125]);
                            Session::set('cError',false);
                        }elseif($cError == 'time'){
                            $now = date('i');
                            $residual = Session::get('residual');
                            $kalan = $now - $residual;
                            $kalans = 11 - $kalan;
                            echo Client::alert('error',"10 Dakika arayla mail gönderimi yapabilirsiniz.Lütfen bekleyiniz. Kalan süre : $kalans dakika");
                            Session::set('cError',false);
                        }else{
                            echo Client::alert('info',$lng[126]);
                        }
                    ?>
                    <form action="<?=URI::get_path('profile/emailchange2')?>" method="POST">
                        <div class="bg-light">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input" for="register-email"><?=$lng[23]?></label>
                                    </td>
                                    <td>
                                        <input type="password" id="password" name="password" placeholder="<?=$lng[23]?>" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="register-input" for="register-email" style="margin-top: -23px;"><?=$lng[24]?></label>
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
                    <?php else:?>
                    <?php
                        $cError = Session::get('cError');
                        if($cError == 'recaptcha'){
                            echo Client::alert('error',$lng[115]);
                            Session::set('cError',false);
                        }elseif($cError == 'filter'){
                            echo Client::alert('error',$lng[126]);
                            Session::set('cError',false);
                        }elseif($cError == 'empty'){
                            echo Client::alert('error',$lng[126]);
                            Session::set('cError',false);
                        }elseif($cError == 'wrong'){
                            echo Client::alert('error',$lng[127]);
                            Session::set('cError',false);
                        }elseif($cError == 'length'){
                            echo Client::alert('error',$lng[128]);
                            Session::set('cError',false);
                        }elseif($cError == 'length2'){
                            echo Client::alert('error',$lng[129]);
                            Session::set('cError',false);
                        }elseif($cError == 'format'){
                            echo Client::alert('error',$lng[130]);
                            Session::set('cError',false);
                        }elseif($cError == 'error'){
                            echo Client::alert('error',$lng[131]);
                            Session::set('cError',false);
                        }elseif($cError == 'OK'){
                            echo Client::alert('success',$lng[132]);
                            Session::set('cError',false);
                        }
                    ?>
                        <form action="<?=URI::get_path('profile/emailchange')?>" method="POST">
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
                    <?php endif; ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>