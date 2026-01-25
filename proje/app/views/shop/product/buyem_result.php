<?php $result = $this->all['result'];
?>
<div id="notEnoughCash" class="contrast-box sys-message">
    <?php if ($result == 'false'):?>
        <?php if ($this->all['message'] == 'coins'):?>
		<?php $info = $this->all['data']; ?>
        <div class="dark-grey-box clearfix">
            <div class="clearfix">
                <div class="item-showcase   span2">
                    <div id="image" class="picture_wrapper ">
                        <img class="item-thumb" src="<?= URL.$info[2]?>" width="98" height="98" alt="" />
                    </div>
                </div>
                <div class="money-showcase  span5 ">
                    <h2>Ejderha Markası yetersiz mi?</h2>
                    <div class="currency_status_box" style="float: left; margin-right: 5%;">
                        <p>Şu anki hesap durumum:</p>
                        <ul class="currency_status clearfix">
                            <li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Markası" src="<?=URI::public_path('images/em_coins.png')?>" width="16" height="16" alt="Ejderha Parası" />
                                    <span class="end-price" data-currency="<?=$info[1]?>"><?=$info[1]?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="currency_status_box">
                        <p>Gerekli marka miktarı:</p>
                        <ul class="currency_status clearfix">
                            <li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Markası" src="<?=URI::public_path('images/em_coins.png')?>" width="16" height="16" alt="Ejderha Parası" />
                                    <span class="end-price" data-currency="<?=$info[0]?>"><?= $info[3] * ($info[0]-$info[1])?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="alternativ_payment clearfix">
            <div class="alternativ_payment_head">
                <h3>Ne yapabilirsin?</h3>
                <div class="clearfix">
                    <h4>Markette harcadığın ejderha parası tutarı kadar hesabına marka yüklenir.</h4>
                </div>
            </div>
        </div>
    <?php elseif ($this->all['message'] == 'depo'):?>
		<?php $info = $this->all['data']; ?>
        <div class="dark-grey-box clearfix">
            <div class="clearfix">
                <div class="item-showcase   span2">
                    <div id="image" class="picture_wrapper ">
                        <img class="item-thumb" src="<?= URL.$info[2]?>" width="98" height="98" alt="" />
                    </div>
                </div>
                <div class="money-showcase  span5 ">
                    <h2>Nesne market deponda hiç yer yok!</h2>
                    <div class="currency_status_box" style="float: left; margin-right: 5%;">
                        <p>Şu anki hesap durumum:</p>
                        <ul class="currency_status clearfix">
                            <li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Markası" src="<?=URI::public_path('images/em_coins.png')?>" width="16" height="16" alt="Ejderha Parası" />
                                    <span class="end-price" data-currency="<?=$info[1]?>"><?=$info[1]?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="alternativ_payment clearfix">
            <div class="alternativ_payment_head">
                <h3>Nesne Market Deponu Boşaltmalısın...</h3>
                <div class="clearfix">
                </div>
            </div>
        </div>
	<?php elseif ($this->all['message'] == "error"):?>
		<?php $info = $this->all['data']; ?>
        <div class="dark-grey-box clearfix">
            <div class="clearfix">
                <div class="money-showcase  span5 ">
                    <h2>[<?=$info[0]?>] İşem sırasında bir hata oluştu!</h2>
                    <div class="currency_status_box" style="float: left; margin-right: 5%;">
                        <p>Hatanın sebebi aşağıdakilerden bir tanesi olabilir :</p>
                        <ul>
                            <li>3. parti yazılım kullanarak kontrol sistemini geçmeye çalışıyor olabilirsiniz.</li>
                            <li>Aktif olmayan bir bölüme girmeye çalışıyor olabilirsiniz.</li>
                            <li>Hatalı bir işlem yapmış olabilirsiniz.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php else:?>
        <?php $info = $this->all['data']; ?>
        <div class="dark-grey-box clearfix">
            <div class="clearfix">
                <div class="item-showcase   span2">
                    <div id="image" class="picture_wrapper ">
                        <img class="item-thumb" src="<?= URL.$info[1]?>" width="98" height="98" alt="" />
                    </div>
                </div>
                <div class="money-showcase  span5 ">
                    <h2><i class="fa fa-check"></i>İşlem Başarılı (<?=$info[0]?>)</h2>
                    <div class="currency_status_box" style="float: left; margin-right: 5%;">
                        <p>Şu anki hesap durumum:</p>
                        <ul class="currency_status clearfix">
                            <li>
                                <span>
                                    <img class="ttip" tooltip-content="Ejderha Parası" src="<?=URI::public_path('images/em_coins.png')?>" width="16" height="16" alt="Ejderha Parası" />
                                    <span class="end-price" data-currency="<?=$info[2]?>"><?=$info[2]?></span>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="alternativ_payment clearfix">
            <div class="alternativ_payment_head">
                <h3>Lütfen Nesne Market Deponuzu Kontrol Ediniz...</h3>
                <div class="clearfix">
                </div>
            </div>
        </div>
    <?php $newEm = $info[2]; ?>
        <script>
            $(document).ready(function () {
                $('#balances2').text("<?=$newEm?>");
            });
        </script>
    <?php endif;?>

</div>



