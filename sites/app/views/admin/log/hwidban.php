<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"60") == true):?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Banlanan HWID'ler</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
			<?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "0"):?>
				Güvenli Bilgisayar sistemi aktif değilse bu sayfayı görüntüleyemezsiniz!
			<?php else:?>
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                   <thead>
                    <tr>
                        <th>#</th>
                        <th>Adı</th>
                        <th>HWID Adresi</th>
						<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                        <th>İşlem</th>
						<?php endif;?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->hwidban as $key => $row):?>
                        <?php
                        $id = $row['hwid'];
                        $name = \StaticGame\StaticGame::sql("SELECT login FROM ".ACCOUNT_DB_NAME.".account WHERE ".SECURITYPCTABLE3." = '?' LIMIT 1",[$id]);
                        ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$name[0]['login'];?></td>
                            <td><?=$row['hwid'];?></td>
                            <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
							<td><a href="<?=URI::get_path('account/openhwidban/'.$row['hwid'])?>" class="btn red"><i class="fa fa-unlock"></i> HWID Banı Kaldır</a></td>
							<?php endif;?>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
			<?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
