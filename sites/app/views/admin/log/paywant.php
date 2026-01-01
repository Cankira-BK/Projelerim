<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"61") == true):?>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Paywant Kayıtları</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Kullanıcı Adı</th>
                        <th>Ödenen Tutar</th>						                        <th>Kazanılan Tutar</th>
                        <th>Ödeme Kanalı</th>
                        <th>Tarih</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->paywant as $key => $row):?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td><?=$row['ReturnData'];?></td>
                            <td><b><?=$row['OdemeTutari'];?></b> TL</td>                            <td><b><?=$row['NetKazanc'];?></b> TL</td>
                            <td><?=Functions::paywant($row['OdemeKanali']);?></td>
                            <td><?=Functions::zaman($row['Tarih']);?></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
