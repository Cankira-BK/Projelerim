<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"12") == true):?>
<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 17.11.2016
     * Time: 08:28
     */
    if(Session::get('changeOK') == true){
        echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
        Session::set('changeOK',false);
    }
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Kullanılmamış Kuponlar</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>Kupon&nbsp;id</th>
                        <th>Anahtar</th>
                        <th>Ep Miktarı</th>
                        <th>Oluşturulan&nbsp;Tarih</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($this->usedCoupon as $row):?>
						<?php
						$id = $row['account_id'];
						$name = \StaticGame\StaticGame::sql("SELECT login FROM ".ACCOUNT_DB_NAME.".account WHERE id = ?",[$id]);
						?>
                        <tr>
                            <td><?=$row['id'];?></td>
                            <td><?=$row['anahtar'];?></td>
                            <td><?=$row['ep'];?></td>
                            <td><?=$row['create_date'];?></td>
                            <td><div class="margin-bottom-5 text-center">
                                    <a href="<?=URI::get_path('coupon/delete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div></td>
                        </tr>
					<?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif;?>