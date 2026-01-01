<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"59") == true):?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Banlanan Karakterler</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Adı</th>
						<th>Banlayan Yönetici</th>
                        <th>Tarih</th>
                        <th>Banlanma Nedeni</th>
                        <th>Kanıt</th>
						<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                        <th>İşlem</th>
						<?php endif;?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->ban as $key => $row):?>
                        <?php
                        $id = $row['account_id'];
                        $name = \StaticGame\StaticGame::sql("SELECT login FROM ".ACCOUNT_DB_NAME.".account WHERE id = ?",[$id]);
                        ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$name[0]['login']?></td>
							<td><?=$row['who'];?></td>
                            <td><?=Functions::zaman($row['date']);?></td>
                            <td><?=$row['why'];?></td>
                            <td><?=$row['evidence']?></td>
							<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"42") == true):?>
                            <td><a href="<?=URI::get_path('account/openban/'.$row['account_id'])?>" class="btn red"><i class="fa fa-unlock"></i> Banı Kaldır</a></td>
							<?php endif;?>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
