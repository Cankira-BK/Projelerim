<?php
	if(isset($_SESSION['id'])) {
		$coninfo = mysqli_query($sqlServ, "SELECT * FROM account.account where login='".$_SESSION['id']."'");
		$info = mysqli_fetch_array($coninfo);
?>
<div id="header">
	<div class="boxSigns">
		<span class="heading">Ejderha Bileti (EB):</span>
		<span class="marksValue"><?php echo $info['coins'];?></span>
		<!--<a href="/faq" class="tip helpSmallIcon" title="Mergi la pagina de ajutor aici." style="right: 23px;"><img src="img/helpSmallIcon.png" /></a>-->
	</div>
	<div class="boxCoins">
		<span class="heading">Ejderha Parası (EP):</span>
		<span class="coinsValue"><?php echo $info['cash'];?></span>
		<!--<a href="/faq" class="tip helpSmallIcon" title="Mergi la pagina de ajutor aici." style="right: 7px;"><img src="img/helpSmallIcon.png" /></a>-->
		<a href="?s=spend" class="purchaseButton" title="Ejderha Parası Al">Ejderha Parası Siparişi</a>
	</div>
</div>
<div class="userdataDiv">
	<a title="Satın alma geçmişin" href="?s=userdata" class="tip userdataIcon"></a>
</div>

<ul id="breadcrumb">
	<li><a href="?s=home">Ana Sayfa</a></li>
	<li><a>-</a></li>
	<li><a href="?s=logout">Çıkış</a></li>
</ul>
<div id="sidebar1">
	<!--<div id="search">
		<form action="" method="post" name="searchForm" onsubmit="return trySubmit()">
			<input type="text" value="Cauta termen" class="type" name="searchString" onfocus="searchFocusGained()" onblur="searchFocusLost()" maxlength="42" /><input type="submit" value="" class="send" />
		</form>
	</div>-->
	<ul id="mainMenu">
		<?php
		$get_category = mysqli_query($sqlServ, "SELECT * FROM itemshop.ishop_category");
		while($category = mysqli_fetch_object($get_category)) {
			echo '<li><a href="?s=category&id='.$category->id.'" title="'.$category->name.'">'.$category->name.'</a></li>';
		}
		?>
	</ul>
	<?php echo'<br /><font color="#996600;"> Kullanıcı:<br /> '.$_SESSION['id'].'</font>';?>
</div>
<?php
	} else {
?>
<div id="header"></div>
<div id="breadcrumb">&nbsp;</div>
<div id="sidebar1"></div>
<?php
	}
?>
