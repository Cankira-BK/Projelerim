<link href="https://fonts.googleapis.com/css?family=PT+Sans|Ravi+Prakash" rel="stylesheet">
<style>
    h2{
        letter-spacing: .2px;
        color: rgba(86, 0, 21, 0.91);
        font-size: 18px;
        text-align: center;
        margin-top: 15px;
        margin-left: 5px;
    }
    span{
        color: rgba(86, 0, 21, 0.91);
        text-align: center;
        margin-left: 5px;
        margin-right: 5px;
    }
    .content{
        margin-right: 15px;
    }
</style>
<h2><?=$lng[180]?></h2>
<div class="content">
<span><?=$lng[181]?>
    <?=$lng[182]?>
    <?=$lng[183]?>
    <?=$lng[184]?>
    <?=$lng[185]?><br><br>
    <?=$lng[186]?><br><br>
    <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> <?=$lng[187]?>...
</span>
</div>