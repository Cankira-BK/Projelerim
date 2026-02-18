<div class="content">
	<div class="content-bg">
		<div class="content-bg-bottom">
			<h2>NUYA2 - Oyuncu Sıralaması (Top 100)</h2>
			<div id="ranking">
				<br />
				<table border="1">
					<tr>
						<th width="150">Sıra</th>
						<th width="150">İsim</th>
						<th width="150">Seviye</th>
						<th width="150">Exp</th>
						<th width="150">İmparatorluk&nbsp;&nbsp;</th>
					</tr>
				<?php
					mysqli_select_db($sqlServ, 'player');
					$rank = "SELECT * from player WHERE name NOT LIKE '[%]%' order by level desc, exp desc, playtime desc limit 100";
					$query = mysqli_query($sqlServ, $rank);
					$i = 0;
					while($array = mysqli_fetch_array($query)) {
						$i = $i + 1;
						echo "<tr>
						<th width=\"150\"><font color=\"black\">" . $i . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["name"] . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["level"] . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["exp"] . "</font></th>";
						$reich = "SELECT empire from player_index where id = " . $array["account_id"] . "";
						$query2 = mysqli_query($sqlServ, $reich);
						$array2 = mysqli_fetch_array($query2);
						if($array2["empire"] == 1) {
						echo "<th width=\"150\" td align=\"center\"><img src=\"img/1_kl.jpg\"></th></tr>";
						} elseif($array2["empire"] == 2) {
						echo "<th width=\"150\" td align=\"center\"><img src=\"img/2_kl.jpg\"></th></tr>";
						} else {
						echo "<th width=\"150\" td align=\"center\"><img src=\"img/3_kl.jpg\"></th></tr>";
						}
					}
					echo "</table>";
				?>
				<br />
			</div>
			<center><strong><a class="btn" href="?s=guildrank">Lonca Sıralaması</a></strong><br /></center>
			<br class="clearfloat" />
		</div>
	</div>
</div>
<div class="shadow">&nbsp;</div>
