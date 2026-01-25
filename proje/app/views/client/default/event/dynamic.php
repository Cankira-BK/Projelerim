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
	<style>
		.ranked-table {
			display: table;
			width: 241px;
			margin-left: 7px;
		}
		.Heading {
			font-size: 13px !important;
			font-weight: bold !important;
			font-family: calibrib;
			display: table-row;
			text-align: center;
			color: #A07332;
			padding: 7px;
		}
		.Cell {
			display: table-cell;
			padding-top: 5px;
			border-width: thin;
			padding-left: 5px;
		}
		.Row.a {
			text-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
			font-family: arial;
			font-size: 12px;
			display: table-row;
			color: #797070;
			text-align: center;
			background: rgba(255, 255, 255, .02);
			height: 28px;
		}
		.Row.b {
			text-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
			font-family: arial;
			font-size: 12px;
			display: table-row;
			color: #797070;
			text-align: center;
			background: rgba(255, 255, 255, .05);
			height: 28px;
		}
	</style>
</head>
<body>
<div id="container2" class="container2">
	<div id="calendar_board">
		<div id="player-rank" class="ranked-table">
			<div class="Heading">
				<div class="Cell">
					<p>Gün</p>
				</div>
				<div class="Cell">
					<p>Event</p>
				</div>
				<div class="Cell">
					<p>Saat</p>
				</div>
			</div>
			<div style="margin-top:5px;"></div>
			<div class="Row a">
				<div class="Cell">
					<p>Pazartesi</p>
				</div>
				<div class="Cell">
					<p>Derece Etkinliği</p>
				</div>
				<div class="Cell">
					<p><span class="online">20.00-21.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Salı</p>
				</div>
				<div class="Cell">
					<p>Pet Etkinliği</p>
				</div>
				<div class="Cell">
					<p><span class="online">20.00-21.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Çarşamba</p>
				</div>
				<div class="Cell">
					<p>Ayışığı Etkinliği</p>
				</div>
				<div class="Cell">
					<p><span class="online">19.00-20.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Perşembe</p>
				</div>
				<div class="Cell">
					<p>Kart Etkinliği</p>
				</div>
				<div class="Cell">
					<p><span class="online">18.00-22.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Cuma</p>
				</div>
				<div class="Cell">
					<p>Altıgen Sandık</p>
				</div>
				<div class="Cell">
					<p><span class="online">17.00-19.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Cumartesi</p>
				</div>
				<div class="Cell">
					<p>Futbol Topu</p>
				</div>
				<div class="Cell">
					<p><span class="online">18.00-19.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Pazar</p>
				</div>
				<div class="Cell">
					<p>Paskalya Etkinliği</p>
				</div>
				<div class="Cell">
					<p><span class="online">16.00-22.00</span></p>
				</div>
			</div>
			<div class="Row a">
				<div class="Cell">
					<p>Hergün</p>
				</div>
				<div class="Cell">
					<p>Binek Etkinliği</p>
				</div>
				<div class="Cell">
					<p><span class="online">16.00-17.00</span></p>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
    var serverID = "ro";
</script>
<script type="text/javascript" src="<?=URI::public_path('event/js/website.js')?>" async defer></script>
</body>
