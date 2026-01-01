<?php
$account = $this->players['account'];
$status = $account['status'];
$availDt = strtotime($account['availDt']);
$now = time();
$fark = $availDt - $now;
    function find_url($string){
//"www."
        $pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
        $replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank" class="link">\\2.\\3.\\4</a>';

//"http://"
        $pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
        $replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank" class="link">\\2\\3://\\4.\\5</a>';

        $string = preg_replace($pattern_preg1, $replace_preg1, $string);
        $string = preg_replace($pattern_preg2, $replace_preg2, $string);

        return $string;
    }

?>
<div class="content_wrapper left">
    <div class="real_content">

        <h2 class="headline_news active"><span class="title"><?=$lng[136]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
                    <style type="text/css">div.tyg{position:fixed;text-align:left;}div.ght{top:50%;left:50%;width:475px;height:160px;border:1px solid #d8d8d8;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;margin-top:-200px;margin-left:-236px;}</style><style type="text/css">div.tyg:before, div.tyg:after{content:"";position:absolute;z-index:-1 !important;-webkit-box-shadow:0 1px 8px rgba(0,0,0,0.8);-moz-box-shadow:0 1px 8px rgba(0,0,0,0.8);box-shadow:0 1px 8px rgba(0,0,0,0.8);top:0;bottom:0;left:10px;right:10px;-moz-border-radius:100px / 10px;border-radius:100px / 10px;}.tyg h1{font-family:Arial, sans-serif;font-size:15px;color:#888;display:block;background:transparent;height:44px;margin-top:0px;margin-bottom:3px;line-height:44px;padding-left:10px;}.tyg h1 a{font-family:Arial, sans-serif;font-size:15px;color:#888;line-height:44px;text-decoration:none !important;}</style><style>.tyg span{display:block;width:26px;height:24px;position:absolute;top:8px;right:8px;background:url(http://1.bp.blogspot.com/-CRX8xFlnOjU/UhsVq6UJdLI/AAAAAAAAcFo/DDuHXcTNAlY/s28/Close_button_red.png) no-repeat -1px -1px;cursor:pointer;opacity:0.7;}.tyg span:hover{opacity:1;}.tyg span:active{opacity:0.4;}div.tyg:after{right:10px;left:auto;-webkit-transform:skew(8deg) rotate(3deg);-moz-transform:skew(8deg) rotate(3deg);-ms-transform:skew(8deg) rotate(3deg);-o-transform:skew(8deg) rotate(3deg);transform:skew(8deg) rotate(3deg);}

                        .tyg div{position:absolute;z-index:600;top:0px;left:0px;width:475px;height:160px;background: rgb(255,255,255);background: -moz-linear-gradient(top,  rgba(255,255,255,1) 0%, rgba(224,224,224,1) 27%, rgba(255,255,255,1) 27%, rgba(216,216,216,1) 27%, rgba(255,255,255,1) 27%, rgba(255,255,255,1) 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(255,255,255,1)), color-stop(27%,rgba(224,224,224,1)), color-stop(27%,rgba(255,255,255,1)), color-stop(27%,rgba(216,216,216,1)), color-stop(27%,rgba(255,255,255,1)), color-stop(100%,rgba(255,255,255,1)));background: -webkit-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(224,224,224,1) 27%,rgba(255,255,255,1) 27%,rgba(216,216,216,1) 27%,rgba(255,255,255,1) 27%,rgba(255,255,255,1) 100%);background: -o-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(224,224,224,1) 27%,rgba(255,255,255,1) 27%,rgba(216,216,216,1) 27%,rgba(255,255,255,1) 27%,rgba(255,255,255,1) 100%);background: -ms-linear-gradient(top,  rgba(255,255,255,1) 0%,rgba(224,224,224,1) 27%,rgba(255,255,255,1) 27%,rgba(216,216,216,1) 27%,rgba(255,255,255,1) 27%,rgba(255,255,255,1) 100%);background: linear-gradient(to bottom,  rgba(255,255,255,1) 0%,rgba(224,224,224,1) 27%,rgba(255,255,255,1) 27%,rgba(216,216,216,1) 27%,rgba(255,255,255,1) 27%,rgba(255,255,255,1) 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ffffff',GradientType=0 );}

                        div.tyg{_position:absolute;-webkit-box-shadow:0 1px 2px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;-moz-box-shadow:0 1px 2px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;box-shadow:0 1px 2px rgba(0, 0, 0, 0.3), 0 0 20px rgba(0, 0, 0, 0.1) inset;}.ght p{font-family:Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;color:#444;padding:18px;text-decoration:none;}.ght p a:link{font-family:Helvetica, Arial, sans-serif;font-size:13px;font-weight:normal;color:#c44;text-decoration:underline;}div.ght{_bottom:auto;_top:expression(ie6=(document.documentElement.scrollTop+document.documentElement.clientHeight - 52+"px") );}</style><div id="koddostu-156" class="tyg ght" style="display: none;"><div><h1><a>Bilgi Mesajı</a></h1><span onclick="document.getElementById('koddostu-156').style.display='none';"></span><p>

                                Buraya duyuru gelebilir.
                            </p></div></div>
                    <style type="text/css">
                        .topLine {color:#7e7777;}
                        .topLine {
                            -moz-box-shadow: 3px 1px 13px -4px #000;
                            -webkit-box-shadow: 3px 1px 13px -4px #000;
                            box-shadow: 3px 1px 13px -4px #000;
                            color:wheat;
                            height:30px;

                        }
                        .tdunkel {
                            -moz-box-shadow: 3px 1px 13px -4px #000;
                            -webkit-box-shadow: 3px 1px 13px -4px #000;
                            box-shadow: 3px 1px 13px -4px #000;
                            color: #E4A734;
                            padding-left:10px;
                        }
                        .birtablo a,.renkver {color: #7e7777; font-weight:bold;}
                        .profile-btn {
                            margin-bottom: 5px;
                            width: 300px;
                        }
                    </style>

					<?php if ($status == 'BLOCK'):?>
						<?=Client::alert('warning',$lng[137]); ?>
                        <h3><?=$lng[149]?></h3>
                        <center><h4><?=$this->players['ban']['why']?></h4></center><br>
						<?php if ($this->players['ban']['evidence'] != ''):?>
                        <h3><?=$lng[150]?></h3>
                        <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
					<?php endif;?>
					<?php elseif ($availDt > $now):?>
					<?=Client::alert('warning',$lng[138]); ?>
                        <h3><?=$lng[149]?></h3>
                        <center><h4><?=$this->players['ban']['why']?></h4></center><br>
					<?php if ($this->players['ban']['evidence'] != ''):?>
                        <h3><?=$lng[150]?></h3>
                        <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
					<?php endif;?>
                        <div class="bg-light item-container">
                            <center><span id="say" style="font-weight: bold;font-size: 45px;"><?=$fark?></span><br> <?=$lng[139]?></center>
                        </div>
                        <script type="text/javascript">
                            var saniye = <?=$fark+1?>;
                            function bak()
                            {
                                if(saniye != 0)
                                {
                                    saniye = saniye - 1;
                                    document.getElementById("say").innerHTML = saniye;
                                    setTimeout(bak, 1000);
                                }
                            }
                            window.onload=bak;
                        </script>
					<?php endif;?>
                    <table cellspacing="5" cellpadding="5" height="30" class="birtablo">
                        <tbody><tr>
                            <th width="184" class="topLine"><?=$lng[23]?>:</th>
                            <td width="495" class="tdunkel"><?=$this->players['account']['login'];?></td>
                        </tr>
                        <tr>
                        </tr><tr>
                            <th class="topLine"><?=$lng[152]?>:</th>
                            <td class="tdunkel"><?=$this->players['account']['email'];?></td>
                        </tr>
                        <tr>
                            <th class="topLine"><?=$lng[97]?>:</th>
                            <td class="tdunkel"><?=$this->players['account']['phone1'];?></td>
                        </tr>
                        <tr>
                            <th class="topLine"><?=$lng[17]?>:</th>
                            <td class="tdunkel"><?=$this->players['account'][CASH];?> </td>
                        </tr>
                        <tr>
                            <th class="topLine"><?=$lng[18]?>:</th>
                            <td class="tdunkel"> <?=$this->players['account'][MILEAGE];?></td>
                        </tr>
                        </tbody>
                    </table>
                    <p></p>
                    <h3 style="text-align: center"><?=$lng[140]?></h3>
                    <div align="center">
                        <a href="<?=URI::get_path('profile/password')?>" class="list-group-item"><input type="button" class="profile-btn" value="<?=$lng[141]?>"></a>
                        <a href="<?=URI::get_path('profile/email')?>" class="list-group-item"><input type="button" class="profile-btn" value="<?=$lng[142]?>"></a>
                        <a href="<?=URI::get_path('profile/depo')?>" class="list-group-item"><input type="button" class="profile-btn" value="<?=$lng[143]?>"></a>
                        <a href="<?=URI::get_path('profile/ksk')?>" class="list-group-item"><input type="button" class="profile-btn" value="<?=$lng[144]?>"></a>
                        <a href="<?=URI::get_path('profile/save')?>" class="list-group-item"><input type="button" class="profile-btn" value="<?=$lng[145]?>"></a>
                        <?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/pin')?>" class="list-group-item"><input type="button" class="profile-btn" value="Pin Değiştir"></a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/iks')?>" class="list-group-item"><input type="button" class="profile-btn" value="İtem Kilit Değiştir"></a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/hgs')?>" class="list-group-item"><input type="button" class="profile-btn" value="Hesap Kilit Değiştir"></a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/kgs')?>" class="list-group-item"><input type="button" class="profile-btn" value="Karakter Kilit Değiştir"></a>
						<?php endif;?>
						<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
							<a href="<?=URI::get_path('profile/gpc')?>" class="list-group-item"><input type="button" class="profile-btn" value="GüvenliPC Pasifleştir"></a>
						<?php endif;?>
						<a href="<?=URL.SHOP?>" class="list-group-item itemshop itemshop-btn iframe"><input type="button" class="profile-btn" value="<?=$lng[147]?>"></a>
                        <a href="<?=URL.MUTUAL?>" class="list-group-item itemshop itemshop-btn iframe"><input type="button" class="profile-btn" value="<?=$lng[146]?>"></a>
                        <a href="<?=URI::get_path('login/logout')?>" class="list-group-item"><input type="button" class="profile-btn" value="<?=$lng[148]?>"></a>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>