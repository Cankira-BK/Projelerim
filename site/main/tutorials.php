<div class="content content-last">
	<div class="content-bg">
		<div class="content-bg-bottom">
			<h2>NUYA2 - Rehber</h2>
			<div class="firststeps-inner-content">
				<ul class="tabs-nav tabs2">
					<li id="tab1"><a href="?s=howto">İlk Adımlar</a></li>
					<li id="tab2" class="selected"><a href="?s=tutorials">Rehber</a></li>
				</ul>
				<div class="tutorialsbox">
					<p>NUYA2 çevrimiçi MMORPG dünyasına hoş geldin! Giriş yaptıktan sonra burada ek bilgiler edinebilir, farklı imparatorlukları ve çevrimiçi rol yapma deneyiminin sunduğu imkanları keşfedebilirsin. Detaylı bir rehber seni MMORPG dünyasının incelikleriyle tanıştırır ve akıcı ile heyecanlı bir oyun deneyimi için gerekli tuş kombinasyonlarını gösterir.</p>
					<a href="main/tutorial_createcharacter.php" rel="#overlay" class="tutorial-btn">Karakter Oluşturma</a>
					<a href="main/tutorial_introduction.php" rel="#overlay" class="tutorial-btn">Tanıtım</a>
				</div>
				<div class="box-foot"></div>
			</div>
		</div>
	</div>
</div>
<div class="shadow">&nbsp;</div>
<script type="text/javascript">
$(document).ready(function(){
	$(".tutorialsbox a[rel]").overlay({ 
		target: '#overlay',
		expose: 'black',
		 onBeforeLoad: function() { 
            // grab wrapper element inside content 
            var wrap = this.getContent().find(".contentWrap"); 
 
            // load the page specified in the trigger 
            wrap.load(this.getTrigger().attr("href")); 
        }
	});
});
</script>
