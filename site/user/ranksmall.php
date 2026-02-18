<div class="boxes-top">&nbsp;</div>
<?php include("./user/login.inc.php"); ?>
<div class="boxes-middle">&nbsp;</div>
<div class="modul-box modul-box-2">
	<div class="modul-box-bg">
		<div class="modul-box-bg-bottom">
			<h3>Sıralama</h3>
			<?php
				mysqli_select_db($sqlServ, 'player');
				$rank = "SELECT * from player WHERE name NOT LIKE '[%]%' order by level desc, exp desc, playtime desc limit 10;";
				$query = mysqli_query($sqlServ, $rank);
				echo "<div class='form-score'><div class='highscore-player'><ul>";
				$i = 0;
				while($array = mysqli_fetch_array($query)) {
					$i = $i + 1;
					
					$reich = "SELECT empire from player_index where id = " . $array["account_id"] . "";
					$query2 = mysqli_query($sqlServ, $reich);
					$array2 = mysqli_fetch_array($query2);
					if ($array2["empire"] == 1) {
						$empireClass = 'empire1';
					} else if ($array2["empire"] == 2) {
						$empireClass = 'empire2';
					} else {
						$empireClass = 'empire3';
					}
					echo $i % 2 == 0 ? "<li class='light'>" : "<li>";
					echo "<div class='".$empireClass."'>
							<strong class='offset'>" . $i . "</strong> - " . $array["name"] . "<!--(Lv". $array["level"] . ")-->
						</div>
					</li>";
				}
				echo "</ul></div></div>";
			?>
			<center>
				<a href="?s=rankings" class="btn">Top 100</a>
			</center>
			<br />
		</div>
	</div>
</div>
<div class="boxes-bottom">&nbsp;</div>
