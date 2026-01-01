<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"50") == true):?>
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

function permissionConvert($value){
    if ($value == 98){
        return 'Moderatör';
    }elseif ($value == 99){
        return 'Admin';
	}elseif ($value == 97){
        return 'Ticket Yetkilisi';
    }
}
?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Yetkili Listesi</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Kullanıcı Adı</th>
                        <th>Yetkisi</th>
                        <th>İmzası</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->users as $row):?>
                        <tr>
                            <td><?=$row['id'];?></td>
                            <td><?=$row['login'];?></td>
                            <td><?=permissionConvert($row['permission']);?></td>
                            <td><?=$row['name'];?></td>
                            <td><div class="margin-bottom-5 text-center">
                                    <a href="<?=URI::get_path('user/edit/'.$row['id'])?>" class="btn btn-icon-only blue text-center">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?=URI::get_path('user/delete/'.$row['id'])?>" class="btn btn-icon-only dark text-center">
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