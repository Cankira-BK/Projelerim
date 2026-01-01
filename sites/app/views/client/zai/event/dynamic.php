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
            width: 280px;
            margin-left: 0px;
		}
		.Heading {
			font-size: 13px !important;
			font-weight: bold !important;
			font-family: calibrib;
			display: table-row;
			text-align: center;
            color: #9B8D6F;
			padding: 7px;
		}
		.Cell {
			display: table-cell;
			padding-top: 5px;
			border-width: thin;
			padding-left: 5px;
		}
		.Row.a {
            font-family: arial;
            font-size: 12px;
            font-weight: 600;
            display: table-row;
            color: #8e7456;
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
	<div id="calendar_board2">
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
            <?php foreach ($this->events as $row):?>
                <div class="Row a">
                    <div class="Cell">
                        <p><?=$row["day"]?></p>
                    </div>
                    <div class="Cell">
                        <p><?=$row["name"]?></p>
                    </div>
                    <div class="Cell">
                        <p><span class="online"><?=$row["time"]?></span></p>
                    </div>
                </div>
            <?php endforeach;?>
		</div>
	</div>
</div>
<script type="text/javascript">
    var serverID = "ro";
</script>
<script type="text/javascript" src="<?=URI::public_path('event/js/website.js')?>" async defer></script>
</body>
