<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"58") == true):?>
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
                        <th>Adet</th>
                        <th>Tarih</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->shop['all'] as $key => $row):?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><a href="<?=URI::get_path('account/account/'.$row['account_id'])?>" target="_blank"><?=$row['account_name'];?></a></td>
                            <td><?=$row['item_name'];?></td>
                            <td><?=$row['adet']?></td>
                            <td><?=Functions::zaman($row['tarih']);?></td>
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
                <table class="table table-striped table-bordered table-hover order-column" id="sample_3">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Eşya Adı</th>
                        <th>Vnum</th>
                        <th>Satılma Sayısı</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->shop['popular'] as $key => $row):?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$row['item_name']?></td>
                            <td><?=$row['item_id'];?></td>
                            <td><?=$row['adet']?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
