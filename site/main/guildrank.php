<div class="content">
	<div class="content-bg">
		<div class="content-bg-bottom">
			<h2>NUYA2 - Lonca Sıralaması (Top 100)</h2>
			<div id="ranking">
				<br />
				<table border="1">
					<tr>
						<th width="150">Sıra</th>
						<th width="150">İsim</th>
						<th width="150">Galibiyet</th>
						<th width="150">Beraberlik</th>
						<th width="150">Mağlubiyet</th>
					</tr>
				<?php
					mysqli_select_db($sqlServ, 'player');
					$rank = "SELECT * from guild order by win desc limit 100";
					$query = mysqli_query($sqlServ, $rank);
					$i = 0;
					while($array = mysqli_fetch_array($query)) {
						$i = $i + 1;
						echo "<tr>
						<th width=\"110\"><font color=\"black\">" . $i . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["name"] . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["win"] . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["draw"] . "</font></th>
						<th width=\"150\"><font color=\"black\">" . $array["loss"] . "</font></th>";
					}
					echo "</table>";
				?>
				<br />
			</div>
			<center><strong><a class="btn" href="?s=rankings">Oyuncu Sıralaması</a></strong><br /></center>
			<br class="clearfloat" />
		</div>
	</div>
</div>
<div class="shadow">&nbsp;</div>
