<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"8") == true):?>
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
$Labels = ['weapon'=>'Silah','armor'=>'Zırh','wrist'=>'Bileklik','foots'=>'Ayakkabı','neck'=>'Kolye','head'=>'Kafalık','shield'=>'Kalkan','ear'=>'Yüzük','costume_body'=>'Kostüm','costume_weapon'=>'Kostüm Silah','costume_hair'=>'Kostüm Saç','costume_mount'=>'Binek','costume_pet'=>'Pet','costume_pendant'=>'Tılsım','other'=>'Diğer'];
$efsun = Functions::gameIn('efsunlar');
?>
<div class="row" style="margin-bottom: 340px;">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Efsun Listesi</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th class="text-center"> Bonus Türü </th>
                            <th class="text-center"> Bonus Adı </th>
                            <th class="text-center"> Bonus Oranı </th>
                            <th > Sil </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->bonuslist as $rows):?>
                            <tr>
                                <td class="text-center"> <?= $Labels[$rows['wear_flag']];?> </td>
                                <td class="text-center"> <?= $efsun[$rows['apply']];?> </td>
                                <td class="text-center"> <?= $rows['rate'];?> </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?=URI::get_path('product/bonusdelete/'.$rows['id']);?>" class="btn btn-outline btn-circle dark btn-sm black">
                                            <i class="fa fa-trash-o"></i> </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->
    </div>
</div>
<?php endif;?>