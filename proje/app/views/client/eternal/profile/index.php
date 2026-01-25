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
<link rel="stylesheet" href="<?=URI::public_path()?>asset/css/account-panel.css"/>
<aside id="right">
    <div id="content_ajax">
        <article class="page_article">
            <h2 class="head"><?=$lng[136]?><a href="<?=URI::get_path('index')?>" class="back-to-account" title="Geri"></a></h2>
            <div class="body">
				<?php if ($status == 'BLOCK'):?>
					<?=Functions::alert('warning',$lng[137]); ?>
				<?php elseif ($availDt > $now):?>
					<?=Functions::alert('warning',$lng[138]); ?>
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
                <div class="warfg_account">
                    <section id="warfg_ucp_buttons">
						<?php if ($status == 'OK' && $availDt <= $now):?>
                        <ul id="accoun_panel_menu">
                            <li>
                                <a href="<?=URI::get_path('profile/password')?>">
                                    <span>
										<p><?=$lng[141]?></p>
										<?=$lng[178]?>
									</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=URI::get_path('profile/email')?>">
                                    <span>
										<p><?=$lng[142]?></p>
										<?=$lng[179]?>
									</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=URI::get_path('profile/depo')?>">
                                    <span>
										<p><?=$lng[143]?></p>
										<?=$lng[178]?>
									</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=URI::get_path('profile/ksk')?>">
                                    <span>
										<p><?=$lng[144]?></p>
										<?=$lng[178]?>
									</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=URI::get_path('profile/save')?>">
                                    <span>
										<p><?=$lng[145]?></p>
										<?=$lng[180]?>
									</span>
                                </a>
                            </li>
							<?php if(\StaticDatabase\StaticDatabase::systems('pin_durum') === "1"):?>
								<li>
									<a href="<?=URI::get_path('profile/pin')?>">
										<span>
											<p>Pin Değiştir</p>
											Pin Değiştir
										</span>
									</a>
								</li>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('itemkilit_durum') === "1"):?>
								<li>
									<a href="<?=URI::get_path('profile/iks')?>">
										<span>
											<p>İtem Kilit Değiştir</p>
											İtem Kilit Değiştir
										</span>
									</a>
								</li>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('hesapkilit_durum') === "1"):?>
								<li>
									<a href="<?=URI::get_path('profile/hgs')?>">
										<span>
											<p>Hesap Kilit Değiştir</p>
											Hesap Kilit Değiştir
										</span>
									</a>
								</li>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('karakterkilit_durum') === "1"):?>
								<li>
									<a href="<?=URI::get_path('profile/kgs')?>">
										<span>
											<p>Karakter Kilit Değiştir</p>
											Karakter Kilit Değiştir
										</span>
									</a>
								</li>
							<?php endif;?>
							<?php if(\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
								<li>
									<a href="<?=URI::get_path('profile/gpc')?>">
										<span>
											<p>GüvenliPC Pasifleştir</p>
											GüvenliPC Pasifleştir
										</span>
									</a>
								</li>
							<?php endif;?>
                            <li>
                                <a class="itemshop itemshop-btn iframe" href="<?=URL.MUTUAL?>">
                                    <span>
										<p><?=$lng[146]?></p>
										<?=$lng[181]?>
									</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=URL.SHOP?>" target="_blank">
                                    <span>
										<p><?=$lng[147]?></p>
										<?=$lng[182]?>
									</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?=URI::get_path('login/logout')?>">
                                    <span>
										<p><?=$lng[148]?></p>
										<?=$lng[183]?>
									</span>
                                </a>
                            </li>
                        </ul>
						<?php else:?>
                            <h3><?=$lng[149]?></h3>
                            <center><h4><?=$this->players['ban']['why']?></h4></center><br>
							<?php if ($this->players['ban']['evidence'] != ''):?>
                                <h3><?=$lng[150]?></h3>
                                <center><h4><?=find_url($this->players['ban']['evidence'])?></h4></center><br>
							<?php endif;?>
						<?php endif;?>
                        <div class="clear"></div>
                    </section>
                    <div class="ucp_divider" style="margin-top:15px;"></div>
                    <section id="ucp_top">
                            <section id="ucp_info" style="padding-right:15px;padding-left:15px;width: 100%;">
                                <aside>
                                    <table width="100%">
                                        <tbody>
                                        <tr>
                                            <td width="40%"><?=$lng[23]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->players['account']['login'];?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[152]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->players['account']['email'];?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%">Telefon :</td>
                                            <td width="50%" class="wheat"><?=$this->players['account']['phone1'];?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[17]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->players['account'][CASH];?></td>
                                        </tr>
                                        <tr>
                                            <td width="40%"><?=$lng[18]?> :</td>
                                            <td width="50%" class="wheat"><?=$this->players['account'][MILEAGE];?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </aside>
                            </section>
                            <div class="clear"></div>
                        </section>
							<?php foreach ($this->players['player'] as $key=>$row):?>
                                <a href="<?=URI::get_path("detail/player/".$row['name'])?>">
                                    <div id="profileBox" class="player-table" style="float: left;width: 49%;">
                                        <div class="player-row">
                                            <img src="<?=URL.'data/chrs/medium/'.$row['job'].'.png'?>" alt="<?=Functions::jobName($row['job']);?>" style="    display: block;margin-left: auto;margin-right: auto;">
                                            <center><span style="font: normal 18px 'Palatino Linotype', 'Times', serif; text-transform: none;color: wheat"><?=$row['name']?></span></center><br>
                                            <center><span><?=$lng[33]?> : <?=Functions::jobName($row['job']);?></span></center>
                                            <center><span><?=$lng[68]?> : <?=$row['level'];?></span></center>
                                            <center><span><?=$lng[40]?> : <?=Functions::convertTimeMinutes($row['playtime']);?> <?=$lng[42]?>.</span></center>
                                            <center><span><?=$lng[39]?> : <?=Functions::zaman($row['last_play']);?></span></center>
                                        </div>
                                    </div>
                                </a>
							<?php endforeach;?>
                        <div class="clear"></div>
                </div>
            </div>
        </article>
    </div>
</aside>