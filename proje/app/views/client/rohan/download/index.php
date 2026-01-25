<main class="content">
  <section class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="box">
          <div class="box">
            <h2><?=$lng[0]?></h2>
            <div class="alert alert-warning text-center" style="color:#000">
              <strong>Dosyayı indirdikten sonra .zip içindeki klasörü masaüstüne çıkartıp <?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>.exe'den oyuna giriş yapınız.<br>Aksi taktirde oyuna giriş yapamazsınız!</strong>
            </div>
            <table class="table downloads-table table-red-heading table-striped">
              <thead>
                <tr>
                  <th>İndirme Linki</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
					<?php foreach ($this->pack as $key => $row):?>
					<tr>
                      <td><?=$row['name'];?> <br><small><?=$lng[53]?> : <?=$row['size'];?></small></td>
					  <td><img src="<?=$row['image']?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" width="70px;" style=" margin-top: 12px;"></td>
                      <td class="text-right"><a href="<?=$row['url']?>" class="btn btn-xs btn-danger" target="_blank"><?=$lng[184]?></a></td>
                    </tr>
                     <?php endforeach;?>
                                                </tbody>
            </table>
            <hr>
            <center>
              <h2>
                Sistem Gereksinimleri              </h2>
            </center>
            <hr>
            <div class="panel-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td><b>Bileşen Adı</b></td>
                    <td><b>En Düşük Gereksinim</b></td>
                    <td><b>Orta Derece Gereksinim</b></td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Boş Alan (HDD)</td>
                    <td>2GB</td>
                    <td>3GB ve üzeri</td>
                  </tr>
                  <tr>
                    <td>Bellek (RAM)</td>
                    <td>2GB</td>
                    <td>4GB ve üzeri</td>
                  </tr>
                  <tr>
                    <td>İşlemci (CPU)</td>
                    <td>Pentium 3 , 1GHz</td>
                    <td>İntel core i3 ve üzeri</td>
                  </tr>
                  <tr>
                    <td>Ekran Kartı (GPU)</td>
                    <td>512Mb</td>
                    <td>1Gb ve üzeri</td>
                  </tr>
                  <tr>
                    <td>İşletim Sistemi</td>
                    <td>Win XP</td>
                    <td>Win 7 ve üzeri</td>
                  </tr>
                  <tr>
                    <td>DirectX</td>
                    <td>9</td>
                    <td>9 ve üzeri</td>
                  </tr>
                </tbody>
              </table>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>