<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"58") == true):?>
<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 05.05.2017
     * Time: 17:06
     */
    ?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Satın Alınan Eşyalar</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kullanıcı Adı</th>
                        <th>Eşya İsmi</th>
                        <th>İşlem</th>
                        <th>Tarih</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->shop['all'] as $key => $row):?>
                        <?php
                        $id = $row['aid'];
                        $name = \StaticGame\StaticGame::sql("SELECT login FROM ".ACCOUNT_DB_NAME.".account WHERE id = ?",[$id]);
                        ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$name[0]['login']?></td>
                            <td><?=$row['item_name'];?></td>
                            <td><?=$row['what']?></td>
                            <td><?=Functions::zaman($row['date']);?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">En Çok Satılan Eşyalar</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Eşya Adı</th>
                        <th>Vnum</th>
                        <th>Adet</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->shop['popular'] as $key => $row):?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$row['item_name']?></td>
                            <td><?=$row['item_vnum'];?></td>
                            <td>Toplam <b><?=$row['toplam']?></b> adet satıldı!</td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
