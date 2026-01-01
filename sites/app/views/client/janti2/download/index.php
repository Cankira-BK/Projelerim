<main class="content fontSizeOnUc">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
                Oyunu İndir </center>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-hover">
                <tbody>
				<?php foreach ($this->pack as $key => $row):?>
                    <tr>
                        <td style="color:#fff"><?=$row['name'];?> <?=$key+1?>. İndirme Linki</td>
                        <td style="vertical-align:middle;text-align:right;"><a href="<?=$row['url']?>" class="list-group-item" target="_new"><i class="glyphicon glyphicon-download-alt"></i> &nbsp; Oyunu İndir</a></td>
                    </tr>
<?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
                Sistem Gereksinimleri </center>
        </div>
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
</main>