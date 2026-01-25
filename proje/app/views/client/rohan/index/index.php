<main class="content">
  <div class="row p-0">
    <div class="col-lg-4" style="padding:0px;">
      <div class="top-news" style="height: 290px;background-image: url(<?=URI::public_path('')?>/assets/Theme/images/news-img-1.jpg);">
        <div class="top-news-title">
          <a href="#">Oyun Rehberi</a>
        </div>
        <div class="top-news-info">
          Serverimiza yeni mi başlıyorsun ? Oyun rehberi ile serverimizdaki özellikleri görüntüleyebilirsin.        </div>
                  <div class="top-news-read-more">
            <i class="nav-icon"></i><a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim')?>">Rehbere git</a>
          </div>
              </div>
    </div>
    <div class="col-lg-4" style="padding:0px;">
      <div class="top-news" style="height: 290px;background-image: url(<?=URI::public_path('')?>/assets/Theme/images/news-img-2.jpg);">
        <div class="top-news-title">
          <a href="#">Tanıtım Videoları</a>
        </div>
        <div class="top-news-info">
          Serverimiz hakkında bilgi mi edinmek istiyorsun ? Youtube kanalımızdaki videoları izleyerek bilgilenebilirsin.        </div>
        <div class="top-news-read-more">
          <i class="nav-icon"></i><a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>">Videolara Gözat</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4" style="padding:0px;">
      <div class="top-news" style="height: 290px;background-image: url(<?=URI::public_path('')?>/assets/Theme/images/news-img-3.jpg);">
        <div class="top-news-title">
          <a href="#">Sosyal Medya</a>
        </div>
        <div class="top-news-info">
          Server hakkında yapılan çalışmalar,güncellemeler, etkinlikler vb gibi faaliyetlerden haber almak için facebook sayfamızı takip edin.        </div>
                  <div class="top-news-read-more">
            <i class="nav-icon"></i><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>">Facebook'a Git</a>
          </div>
              </div>
    </div>
  </div>
  
  <div class="tabBlockButton">
    <span class="tab-button active" data-tab="news"><?=$lng[62]?></span>
  </div>
  <div class="tab-block active" id="news">
		<?php Cache::open('patch');?>
		<?php if (Cache::check('patch')):?>
		<?php foreach ($this->result['patch'] as $row):?>
		<div class="topNewsBlock flex-s">
          <div class="topNewsInfo" style="width:100%">
            <h2><?=$row['title'];?> </h2>
            <div class="flex-s-c">
              <a href="<?=URI::get_path('patch/view/'.$row['id'])?>" target="_blank" class="button button-small btn-block"><?=$lng[63]?></a>
              <span class="date" style="float:right;font-size:12px;line-height:20px;"><?=$row['tarih'];?></span>
            </div>
          </div>
        </div>
        <hr>
        <?php endforeach; ?>
        <?php endif;?>
        <?php Cache::close('patch');?>
  </div>
  <?php if (\StaticDatabase\StaticDatabase::settings('facebook_status')):?>
  <div class="tabBlockButton">
    <span class="tab-button active" data-tab="facebook">Facebook</span>
  </div>
  <div class="tab-block active" id="facebook">
		<div class="facebook">
			<div class="fb-page" data-href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" data-tabs="timeline" data-width="462" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="fb-xfbml-parse-ignore" style="display: none;margin-left: 65px;"><a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>"><?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?></a></blockquote></div>
        </div>
  </div>
  <?php endif;?>
</main>