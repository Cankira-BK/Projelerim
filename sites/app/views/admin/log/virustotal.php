<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"63") == true):?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">VirusTotal Kayıtları</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kullanıcı</th>
                        <th>Tarama Türü</th>
                        <th>Tarama Adresi</th>
                        <th>Tarih</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->virustotal as $key => $row):?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$row['User'];?></td>
                            <td><b><?=$row['ScanType'];?></b></td>
                            <td><a href="<?=$row['ScanURL'];?>" title="<?=$row['ScanID'];?>" target="_blank">Link'i Görüntüle</a></td>
                            <td><?=Functions::zaman($row['Date']);?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
