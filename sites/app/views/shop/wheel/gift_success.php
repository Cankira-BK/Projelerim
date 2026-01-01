<?php
$info = $this->all["data"];
$newCoins = $info[2];
$newEm = $info[3];
?>
<div id="notEnoughCash" class="contrast-box sys-message">
    <div class="dark-grey-box clearfix">
        <div class="clearfix">
            <div class="item-showcase   span2">
                <div id="image" class="picture_wrapper ">
                    <img class="item-thumb" src="<?= URL . $info[1] ?>" width="98" height="98" alt=""/>
                </div>
            </div>
            <div class="money-showcase  span5 ">
                <h2><i class="fa fa-check"></i><?= $info[0] ?></h2>
                <div class="currency_status_box" style="float: left; margin-right: 5%;">
                    <p>Şu anki hesap durumum:</p>
                    <ul class="currency_status clearfix">
                        <li>
                            <span>
                                <img class="ttip" tooltip-content="Ejderha Parası" src="<?= URI::public_path('images/coins.png') ?>" width="16" height="16" alt="Ejderha Parası"/>
                                <span class="end-price" data-currency="<?=$newCoins?>"><?=$newCoins?></span>
                            </span>
                        </li>
                        <li>
                            <span>
                                <img class="ttip" tooltip-content="Ejderha Parası" src="<?= URI::public_path('images/em_coins.png') ?>" width="16" height="16" alt="Ejderha Parası"/>
                                <span class="end-price" data-currency="<?=$newEm?>"><?=$newEm?></span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="alternativ_payment clearfix">
        <div class="alternativ_payment_head">
            <h4>Eşya nesne market deposuna aktarılmıştır. Lütfen kontrol ediniz.</h4>
            <div class="clearfix">
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#balances1').text("<?=$newCoins?>");
        $('#balances2').text("<?=$newEm?>");
    });
</script>