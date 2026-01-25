<?php
    date_default_timezone_set('Asia/Bahrain');
    $first = date("Y-m-d H:i:s", mktime(0, 0, 0, date("m"), 1,   date("Y")));
    $today = new DateTime(date("Y-m-d H:i:s"));
    $date = new DateTime($first);

    $month = $date->format('m');
    $year = $date->format('Y');
    $dayInMonth = cal_days_in_month(CAL_GREGORIAN,$month,$year);
    $firstDay =strftime("%A", strtotime($date->format("Y-m-d H:i:s")));
    function convertDay ($day){
        if ($day == "Monday")
            $data = 7;
        elseif ($day == "Tuesday")
            $data = 6;
        elseif ($day == "Wednesday")
            $data = 5;
        elseif ($day == "Thursday")
            $data = 4;
        elseif ($day == "Friday")
            $data = 3;
        elseif ($day == "Saturday")
            $data = 2;
        else
            $data = 1;
        return $data;
    }
    function convertDay2 ($day){
        if ($day == "Monday")
            $data = 1;
        elseif ($day == "Tuesday")
            $data = 2;
        elseif ($day == "Wednesday")
            $data = 3;
        elseif ($day == "Thursday")
            $data = 4;
        elseif ($day == "Friday")
            $data = 5;
        elseif ($day == "Saturday")
            $data = 6;
        else
            $data = 7;
        return $data;
    }
    function howMuch($value){
        if ($value == 0)
            $data = 0;
        else
            $data = 1;
        return $data;
    }
    function convertMonth($value){
        if ($value == '01')
            $data = 'Ocak';
        elseif ($value == '02')
            $data = 'Şubat';
        elseif ($value == '03')
            $data = 'Mart';
        elseif ($value == '04')
            $data = 'Nisan';
        elseif ($value == '05')
            $data = 'Mayıs';
        elseif ($value == '06')
            $data = 'Haziran';
        elseif ($value == '07')
            $data = 'Temmuz';
        elseif ($value == '08')
            $data = 'Ağustos';
        elseif ($value == '09')
            $data = 'Eylül';
        elseif ($value == '10')
            $data = 'Ekim';
        elseif ($value == '11')
            $data = 'Kasım';
        else
            $data = 'Aralık';
        return $data;
    }
    $howMuch1 = ($dayInMonth - convertDay($firstDay))%7;
    $howMuch2 = floor(($dayInMonth - convertDay($firstDay)) / 7);
    $howMuch = 1 + $howMuch2 + howMuch($howMuch1);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path('event/css/style.css')?>"/>
    <link rel="stylesheet" type="text/css" href="<?=URI::public_path('event/css/normalize.css')?>"/>
    <link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>
<body>
<div id="container" class="container" align="center">
    <div id="calendar_board" align="center">
        <div id="timezone_changer" data-time="" style="display: none;"></div>
        <div id="timezone_changer2" data-time=""></div>
        <div id="calendar">
            <div id="calendar_month"><?= convertMonth($today->format('m'));?></div>
            <div id="calendar_day_displayed"><?=$today->format('d');?></div>
            <div id="event_time">-</div>
            <div id="event_name">Event Yok</div>
        </div>
        <table id="month_days">
            <tr id="weekdays_title">
                <td>Pt</td>
                <td>Sa</td>
                <td>Ça</td>
                <td>Pe</td>
                <td>Cu</td>
                <td>Ct</td>
                <td>Pa</td>
            </tr>
            <!--1. Week-->
            <tr class="weekdays">
                <?php if (convertDay2($firstDay) == 1):?>
                <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                <?php endfor;?>
                <?php elseif (convertDay2($firstDay) == 2):?>
                    <td class="day_islower">-</td>
                    <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                <?php elseif (convertDay2($firstDay) == 3):?>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                <?php elseif (convertDay2($firstDay) == 4):?>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                <?php elseif (convertDay2($firstDay) == 5):?>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                <?php elseif (convertDay2($firstDay) == 6):?>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                <?php elseif (convertDay2($firstDay) == 7):?>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <td class="day_islower">-</td>
                    <?php for ($i = 1; $i <= convertDay($firstDay); $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                <?php endif;?>
            </tr>
            <!--1. Week-->
            <!--2. Week-->
            <tr class="weekdays">
            <?php for ($i = convertDay($firstDay)+1; $i <= convertDay($firstDay)+7; $i++):?>
                <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
            <?php endfor;?>
            </tr>
            <!--2. Week-->
            <!--3. Week-->
            <tr class="weekdays">
                <?php for ($i = convertDay($firstDay)+8; $i <= convertDay($firstDay)+14; $i++):?>
                    <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                <?php endfor;?>
            </tr>
            <!--3. Week-->
            <!--4. Week-->
            <tr class="weekdays">
                <?php for ($i = convertDay($firstDay)+15; $i <= convertDay($firstDay)+21; $i++):?>
                    <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                <?php endfor;?>
            </tr>
            <!--4. Week-->
            <!--5. Week-->
            <?php if ($howMuch < 6):?>
            <tr class="weekdays">
                <?php for ($i = convertDay($firstDay)+22; $i <= $dayInMonth; $i++):?>
                    <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                <?php endfor;?>
            </tr>
            <?php endif;?>
            <!--5. Week-->
            <!--6. Week-->
            <?php if ($howMuch >= 6):?>
                <tr class="weekdays">
                    <?php for ($i = convertDay($firstDay)+22; $i <= convertDay($firstDay)+28; $i++):?>
                        <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                    <?php endfor;?>
                </tr>
            <tr class="weekdays">
                <?php for ($i = convertDay($firstDay)+29; $i <= $dayInMonth; $i++):?>
                    <td class="
                        <?php if ($today->format('d') > $i):?>
                        day_islower
                        <?php elseif ($today->format('d') == $i):?>
                        day_isselectable day_isselected
                        <?php elseif ($today->format('d') < $i):?>
                        day_isselectable
                        <?php endif;?>
                        "><?=$i?></td>
                <?php endfor;?>
            </tr>
            <?php endif;?>
            <!--6. Week-->
        </table>
    </div>
</div>
<script type="text/javascript">
    var serverID = "ro";
</script>
<script type="text/javascript" src="<?=URI::public_path('event/js/website.js')?>" async defer></script>
</body>
