<?php    $ban = $this->password;    $availDt = strtotime($ban['availDt']);    $now = time();    $fark = $availDt - $now;?>
<div class="main-panel panel-download">
    <div class="main-header">
        <?=$lng[141]?>
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <?php if ($ban['status'] == 'BLOCK' || $availDt > $now):?>					<?=Client::alert('error',$lng[113]); ?>				<?php endif;?>				<?php if ($ban['status'] == 'OK' && $availDt <= $now):?>				<?php				Session::init();				$cError = Session::get('cError');				if($cError == 'recaptcha'){					echo Client::alert('error',$lng[115]);					Session::set('cError',false);				}elseif($cError == 'filter'){					echo Client::alert('error',$lng[160]);					Session::set('cError',false);				}elseif($cError == 'empty'){					echo Client::alert('error',$lng[160]);					Session::set('cError',false);				}elseif($cError == 'wrong'){					echo Client::alert('error',$lng[161]);					Session::set('cError',false);				}elseif($cError == 'length'){					echo Client::alert('error',$lng[128]);					Session::set('cError',false);				}elseif($cError == 'length2'){					echo Client::alert('error',$lng[162]);					Session::set('cError',false);				}elseif($cError == 'same'){					echo Client::alert('error',$lng[163]);					Session::set('cError',false);				}elseif($cError == 'error'){					echo Client::alert('error',$lng[163]);					Session::set('cError',false);				}elseif($cError == 'OK'){					echo Client::alert('success',$lng[164]);					Session::set('cError',false);				}				?>
                    <form action="<?=URI::get_path('profile/passwordchange')?>" id="ProfileNotifyOGs" method="POST" autocomplete="off">
                        <div class="bg-light">
                            <table>
                                <tbody>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input"><?=$lng[165]?></label>
                                    </td>
                                    <td>
                                        <input type="password" class="form-control grunge" name="old_password" required>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input"><?=$lng[166]?></label>
                                    </td>
                                    <td>
                                        <input type="password" class="form-control grunge" name="new_password" required>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td style="width: 150px;">
                                        <label class="register-input"><?=$lng[167]?></label>
                                    </td>
                                    <td>
                                        <input type="password" class="form-control grunge" name="re_password" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="register-input" style="margin-top: -23px;"><?=$lng[24]?></label>
                                    </td>
                                    <td>
                                        <?=$this->captcha->google(\StaticDatabase\StaticDatabase::settings('sitekey'))->call();?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn"><?=$lng[141]?></button>
                        </div>
                    </form>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>
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