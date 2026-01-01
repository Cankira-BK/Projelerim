<?php
$guild = $this->guild['info'];
    function portrait($level)
    {
        if ($level < 26){
            return '1';
        }elseif ($level < 34){
            return '26';
        }elseif ($level < 42){
            return '34';
        }elseif ($level < 48){
            return '42';
        }elseif ($level < 54){
            return '48';
        }elseif ($level < 61){
            return '54';
        }elseif ($level < 70){
            return '61';
        }elseif ($level < 90){
            return '70';
        }elseif ($level >= 90){
            return '90';
        }
    }
    function jobName($value){
        if ($value == 0 || $value == 4){
            return 'Savascı';
        }elseif ($value == 1 || $value == 5){
            return 'Ninja';
        }elseif ($value == 2 || $value == 6){
            return 'Sura';
        }elseif ($value == 3 || $value == 7){
            return 'Şaman';
        }elseif ($value == 8){
            return 'Lycan';
        }
    }
    function gifName($value){
        if ($value == 0 || $value == 4){
            return 'barbarian';
        }elseif ($value == 1 || $value == 5){
            return 'crusader';
        }elseif ($value == 2 || $value == 6){
            return 'witch-doctor';
        }elseif ($value == 3 || $value == 7){
            return 'wizard';
        }
    }
    function playerStat($date){
        $now = date( 'Y-m-d H:i:s', strtotime('-30 minutes'));
        if ($now > $date){
            return 'off';
        }elseif ($now <= $date){
            return 'on';
        }
    }
?>

<div class="content_wrapper left">
    <div class="real_content">

        <h2 class="headline_news active"><span><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?> | <?=$lng[43]?></span></h2>
        <div class="p4px" style="display: block;">
            <div class="real_content">
                <div class="inner_content news_content">
                    <br>
                    <div style="clear:both"></div>
                    <style type="text/css">

                        .table {
                            display: table;
                        }

                        .row {
                            display: table-row;
                        }

                        .cell {
                            display: table-cell;
                            float: left;
                        }
                        div.cell.CharRight div.childrow, div.cell.CharLeft div.childrow {
                            width: 300px;
                            height: auto;
                            padding: 5px;
                            color:#fff;
                            font-size: 12px;
                            background: rgba(0, 0, 0, 0.2);
                            margin-bottom: 4px;
                        }
                        div.cell.CharLeft div.childrow {
                            width: 100px;
                            text-align: center;
                            line-height: 17px;
                        }

                        div.cell.CharLeft div.childrow.Level {
                            width: 100px;
                            height: 50px;
                            padding: 0px;
                            margin-right: 8px;
                            text-align: center;
                            padding-top: 8px;
                            background: rgba(250, 150, 90, 0.1);
                            line-height: 21px;
                            color:#fff;
                            font-size:12px;
                            margin-top:3px;
                        }
                        div.cell.CharLeft div.childrow.Level span {font-size: 16px;}

                        div.cell.CharLeft div.childrow:first-child {
                            height: 30px;
                            padding-top: 12px;
                            font-size: 15px;
                            color:#8ba9ff;
                            margin-bottom: 10px;
                        }
                        div.cell.CharLeft div.childrow:first-child span {
                            font-size: 15px;
                            color:#f6e9ff;
                        }
                        div.cell.CharRight div.childrow span, div.cell.CharLeft div.childrow span {
                            color:#b3804f;
                        }

                        div.childrow a {
                            font-size: 12px;
                        }
                        div.childrow a small {
                            font-weight: normal;
                        }
                        div.childrow a:hover {
                            color:#fff;
                        }
                        div.cell.CharLeft div.main-title.CharChild {
                            width: 50px;
                            margin-top: 8px;
                            text-align:left;
                            background-position:left;
                        }

                        div.cell.CharRight div.main-title.CharChild {
                            width: 300px;
                            text-align:left;
                            background-position:left;
                        }




                        div.cell.ShopLeft {
                            width: 50px;
                            height: auto;
                        }
                        .row.Shop:hover {
                            background:rgba(0, 0, 0, 0.2);
                        }
                        div.cell.ShopRight {
                            width: 300px;
                            height: auto;
                            padding:10px 10px 17px 10px;
                        }

                        div.cell.ShopLeft .img {
                            width: 80px;
                            height: 80px;
                            margin: 10px;
                            vertical-align: middle;
                            text-align: center;
                            background: rgba(0, 0, 10, 0.2);
                        }
                        div.cell.ShopLeft .img img {
                            margin:24px;
                        }
                        div.cell.ShopLeft .price {
                            width: 60px;
                            margin: 10px;
                            text-align: center;
                            padding: 8px 10px;
                            background: rgba(250, 150, 90, 0.1);
                            line-height: 21px;
                            font-family:Tahoma;
                            color:#fff;
                            font-size: 13px;
                        }

                        div.cell.ShopRight .name {
                            width: 300px;
                            font-size: 13px;
                            height: 17px;
                            color:#ffefcd;
                            padding:5px 0px;
                            margin-bottom: 1px;

                        }
                        div.cell.ShopRight .name span {
                            display: block;
                            padding: 4px 5px 3px 5px;
                            line-height: 10px;
                            background: rgba(0, 0, 0, 0.4);
                            float: right;
                            font-size: 10px;
                        }
                        div.cell.ShopRight .desc {
                            width: 300px;
                            padding: 8px 0;
                            margin-bottom: 18px;
                            height: 32px;
                            line-height: 16px;
                            font-style: italic;
                        }
                        div.cell.ShopRight div.bottom {
                            position:relative;
                            height:28px;
                        }
                        div.cell.ShopRight div.bottom .left {
                            display: inline-block;
                            padding-top: 5px;
                            font-size: 13px;
                            float:left;
                        }

                        div.cell.ShopRight div.bottom .button_1 {
                            position:absolute;
                            right:0px;
                            top:-10px;
                        }

                        .title,
                        .main-title {width:630px;height:26px;text-align:center;text-transform:uppercase;font-size:15px;color:#000;padding-top:8px;margin-top:5px;margin-bottom:15px;}

                        div.cell.CharLeft {
                            width: 160px;
                            height: auto;
                        }
                        div.cell.CharRight {
                            width: 40px;
                            height: auto;
                        }

                        div.statsSec {
                            width: 300px;
                            margin-top: 22px;
                            height: 70px;
                        }

                        div.statsSec .col {
                            width: 111px;
                            height: 50px;
                            margin-right: 8px;
                            display: inline-block;
                            float: left;
                            text-align: center;
                            padding-top: 8px;
                            background: rgba(250, 150, 90, 0.1);
                            line-height: 21px;
                            color:#fff;
                            font-size: 12px;
                        }

                        div.statsSec .col span {
                            font-size: 14px;
                            color: #FBEDDF;
                        }

                        div.statsSec .col:last-child {
                            margin-right: 0px;
                        }
                        div.cell.CharRight div.childrow, div.cell.CharLeft div.childrow {
                            width: 260px;
                            height: auto;
                            padding: 5px;
                            color:#fff;
                            font-size: 12px;
                            background: rgba(0, 0, 0, 0.2);
                            margin-bottom: 4px;
                        }
                        div.cell.CharLeft div.childrow {
                            width: 131px;
                            text-align: center;
                            line-height: 17px;
                        }

                        div.cell.CharLeft div.childrow.Level {
                            width: 141px;
                            height: 50px;
                            padding: 0px;
                            margin-right: 8px;
                            text-align: center;
                            padding-top: 8px;
                            background: rgba(250, 150, 90, 0.1);
                            line-height: 21px;
                            color:#fff;
                            font-size:12px;
                            margin-top:3px;
                        }
                        div.cell.CharLeft div.childrow.Level span {font-size: 16px;}

                        div.cell.CharLeft div.childrow:first-child {
                            height: 43px;
                            padding-top: 12px;
                            font-size: 15px;
                            color:#8ba9ff;
                            margin-bottom: 10px;
                        }
                        div.cell.CharLeft div.childrow:first-child span {
                            font-size: 15px;
                            color:#f6e9ff;
                        }
                        div.cell.CharRight div.childrow span, div.cell.CharLeft div.childrow span {
                            color:#FBEDDF;
                        }

                        div.childrow a {
                            font-size: 12px;
                        }
                        div.childrow a small {
                            font-weight: normal;
                        }
                        div.childrow a:hover {
                            color:#fff;
                        }
                        div.cell.CharLeft div.main-title.CharChild {
                            width: 109px;
                            margin-top: 8px;
                            text-align:left;
                            background-position:left;
                        }

                        div.cell.CharRight div.main-title.CharChild {
                            width: 438px;
                            text-align:left;
                            background-position:left;
                        }

                    </style>
                    <div class="value">
                        <br>
                            <div class="table">
                                <div class="row">
                                    <div class="cell CharRight">
                                        <div class="main-title CharChild"><?=$lng[175]?></div>
                                        <div class="childrow"><span><?=$lng[46]?>:</span> <?=$guild['name']?></div>
                                        <div class="childrow"><span><?=$lng[47]?>:</span> <?=$guild['ladder_point']?></div>
                                        <div class="childrow"><span> EXP:</span> <?=$guild['exp']?></div>
                                        <div class="childrow"><span><?=$lng[48]?>:</span> <img src="<?=URL.'data/flags/'.$guild['empire'].'.png';?>" style="width:30px;" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>"> </div>
                                        <div class="childrow"><span><?=$lng[49]?>:</span> <b><?=$guild['win']?></b> </div>
                                        <div class="childrow"><span><?=$lng[50]?>:</span> <b><?=$guild['draw']?></b> </div>
                                        <div class="childrow"><span><?=$lng[51]?>:</span> <?=$guild['loss']?> </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
