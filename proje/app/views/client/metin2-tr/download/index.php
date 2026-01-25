<div role="main">
<div id="download" class="content content-last">
    <div class="content-bg">
        <div class="content-bg-bottom">
            <h2><?=$lng[0]?></h2>
            <div class="download-inner-content">
                <h3><?=$lng[177]?></h3>
                <br>
                <h2 style="margin-left:15px;padding-left: 0px;margin-bottom:-20px;"></h2>
                <p id="downloadText"></p>
                <div id="highscore">
                    <table border="0" style="table-layout:fixed;color: #8d0404;font-size: 11px;height: 29px;width: 450px;margin-left: 15px;">
                        <tbody>
						<?php foreach ($this->pack as $key => $row):?>
                        <?php if ($key % 2 == 0):?>
                                <tr class="zebra">
                                    <td><?=$row['name'];?></td>
                                    <td><center><?=$row['size'];?></center></td>
                                    <td style="vertical-align:middle;text-align:right;"><a class="btn btn-giris" href="<?=$row['url']?>" target="_blank"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;İndir</a></td>
                                </tr>
                        <?php else:?>
                                <tr>
                                    <td><?=$row['name'];?></td>
                                    <td><center><?=$row['size'];?></center></td>
                                    <td style="vertical-align:middle;text-align:right;"><a class="btn btn-giris" href="<?=$row['url']?>" target="_blank"><i class="glyphicon glyphicon-download-alt"></i> &nbsp;İndir</a></td>
                                </tr>
                        <?php endif;?>
						<?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <br>
                <br class="clearfloat">
                <a href="javascript:void(0)" id="requirements">» <?=$lng[56]?></a>
                <div id="required" style="display: none;">
                    <table border="0">
                        <caption>
							<?=$lng[57]?>                            </caption>
                        <tbody>
                        <tr>
                            <td class="left_td">OS</td>
                            <td>- Win 7, Win 8 (Windows XP itibaren çalışır; destek verilemez.)</td>
                        </tr>
                        <tr>
                            <td class="left_td">CPU</td>
                            <td>- Pentium 3 1GHz</td>
                        </tr>
                        <tr>
                            <td class="left_td">Hafıza</td>
                            <td>- 512MB</td>
                        </tr>
                        <tr>
                            <td class="left_td">Sabit disk</td>
                            <td>- 2 GB</td>
                        </tr>
                        <tr>
                            <td class="left_td">Ekran Kartı</td>
                            <td>- 32MB Ram'den daha yüksek Ekran Kartı</td>
                        </tr>
                        <tr>
                            <td class="left_td">Ses kartı</td>
                            <td>- DirectX 9.0 Desteği</td>
                        </tr>
                        <tr>
                            <td class="left_td">Fare</td>
                            <td>- Windows uyumlu mouse</td>
                        </tr></tbody>
                    </table>
                    <table border="0">
                        <caption>
							<?=$lng[59]?>                            </caption>
                        <tbody>
                        <tr>
                            <td class="left_td">OS</td>
                            <td>- Win 7, Win 8</td>
                        </tr>
                        <tr>
                            <td class="left_td">CPU</td>
                            <td>- Pentium 4 1.8GHz</td>
                        </tr>
                        <tr>
                            <td class="left_td">Hafıza</td>
                            <td>- 1GB</td>
                        </tr>
                        <tr>
                            <td class="left_td">Sabit disk</td>
                            <td>- 3 GB</td>
                        </tr>
                        <tr>
                            <td class="left_td">Ekran Kartı</td>
                            <td>- 64MB RAM'den fazla Ekran Kartıyla</td>
                        </tr>
                        <tr>
                            <td class="left_td">Ses kartı</td>
                            <td>- DirectX 9.0 Desteği</td>
                        </tr>
                        <tr>
                            <td class="left_td">Fare</td>
                            <td>- Windows uyumlu mouse</td>
                        </tr></tbody>
                    </table>
                </div>
                <p id="downloadText">Yetersiz ekran karti hafızası FPS kaybına yol açabilir. Bu sorunu önlemek için oyun ayarlarını yap. İstemcinin aynı zamanda birden fazla kullanıcı tarafından indirilmesi, indirme hızını düşürebilir. Anlayışın için teşekkür ederiz.</p>
                <script type="text/javascript">
                    $(document).ready(function() {
                        $('#requirements').click(function(){
                            $('#required').slideToggle();
                        });
                    });
                </script>
                <div class="download-box-foot"></div>
            </div>
        </div>
    </div>
</div>
</div>