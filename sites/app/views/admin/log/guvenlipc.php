<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"41") == true):?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Aktif Güvenli Bilgisayarlar</span>
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
                    <?php foreach ($this->guvenlipc as $key => $row):?>

                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$row['login'];?></td>
                            <td><?=$row['hwid'];?></td>
                            <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
							<td><a href="<?=URI::get_path('account/gpcstop/'.$row['hwid'])?>" class="btn red"><i class="fa fa-unlock"></i> Güvenli PC Kapat</a></td>
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
