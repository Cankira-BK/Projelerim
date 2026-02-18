<?php
	if(!isset($_SESSION['id'])) {
		header("Location: ?s=login");
		exit;
	} else {
?>
<div id="container">
	<?php include("pages/etc.php") ?>
	<div id="mainContent">
		<h1>Öğeler Listesi</h1>
		<div class="dynContent" style="position:relative">
			<?php
				$get_item = mysqli_query($sqlServ, "SELECT * FROM itemshop.ishop_items");
				while($item = mysqli_fetch_object($get_item)) {
			?>
			<div class="item">
				<div class="itemDesc">
					<div class="thumbnailBgSmall">
						<a href="?s=detail&id=<?php echo $item->id; ?>" title="Daha fazla bilgi" class="openinformation">
							<img src="img/item/<?php echo $item->vnum_icon; ?>.png" onerror="this.src='img/error.png';" width="63px" height="63px" alt="Daha fazla bilgi"/>
						</a>
					</div>
					<p>
						<a href="?s=detail&id=<?php echo $item->id; ?>" title="Daha fazla bilgi" class="openinformation">
							<span class="itemTitle"><?php echo $item->name_item; ?></span>
						</a>
						<span class="line"></span>
						<?php
							if (empty($item->desc))
								{
						?>
						<span>Bu eşyanın açıklaması yok.</span>
						<?php
							} else { 
								echo $item->desc;
							}
						?>
					</p>
				</div>
				<div class="purchaseOptionsWrapper">
					<div class="itemPrice">
						<div class="priceValue"><?php echo $item->count; ?> adet fiyatı:<span class="price">&nbsp;<?php echo $item->price; ?> EP</span></div>
					</div>
					<a href="?s=detail&id=<?php echo $item->id; ?>" title="Daha fazla bilgi" class="purchaseInfo openinformation">Detaylar</a>
					<br class="clearfloat" />
				</div>
			</div>
			<?php
				}
			?>
		</div>
	<div class="endContent"></div>
	</div>
</div>
<?php
	}
?>
