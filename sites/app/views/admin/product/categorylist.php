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
?>
<div class="row" style="margin-bottom: 340px;">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Kategori Listesi</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr>
                            <th class="text-center"> Kategori Id </th>
                            <th class="text-center"> Kategori Türü </th>
                            <th class="text-center"> Kategori İsmi </th>
                            <th > Sil </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->categorylist as $rows):?>
                            <tr>
                                <td class="text-center"> <?= $rows['id'];?> </td>
                                <td class="text-center"> <?php if ($rows['status']){echo '<b style="color: darkred">Alt Menü</b>';}else{echo '<b style="color: darkblue">Ana Menü</b>';}?> </td>
                                <td class="text-center"> <?= $rows['name'];?> </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="<?=URI::get_path('product/categorydelete/'.$rows['id']);?>" class="btn btn-outline btn-circle dark btn-sm black">
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