<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"4") == true):?>
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
                    <i class="glyphicon glyphicon-shopping-cart font-dark"></i>
                    <span class="caption-subject bold uppercase">Market Eşya Listesi</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <a href="<?=URI::get_path('product/deleteall')?>" class="btn btn-danger">Tüm Eşyaları Sil</a>
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>İd</th>
                        <th>İsim</th>
                        <th>Fiyat</th>
                        <th>Durum</th>
                        <th>Tarih</th>
                        <th>İşlemi <i id="what"></i> </th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($this->items as $key=>$row):?>
                    <tr>
                        <td><?= $row['vnum']?></td>
                        <td><?= $row['item_name']?></td>
                        <td><?= $row['coins']?></td>
                        <td>
                            <?php if($row['durum'] == 0):?>
                                <span class="label label-sm label-danger"> <i style="display: none">4</i> Pasif </span>
                            <?php endif;?>
                            <?php if($row['durum'] == 1):?>
                                <span class="label label-sm label-primary"> <i style="display: none">1</i> Aktif </span>
                            <?php endif;?>
                            <?php if($row['durum'] == 3):?>
                                <span class="label label-sm label-warning"> <i style="display: none">3</i> EM Market </span>
                            <?php endif;?>
                            <?php if($row['durum'] == 2):?>
                                <span class="label label-sm label-success"> <i style="display: none">2</i> İndirim </span>
                            <?php endif;?>

                        </td>
                        <td><?= $row['tarih']?></td>
                        <td><div class="margin-bottom-5 text-center">
                                <a href="<?=URI::get_path('product/edit/'.$row['item_id'])?>" id="itemEdit" class="btn btn-icon-only blue text-center">
                                    <i class="fa fa-edit"></i>
                                </a>
								<?php if($row['popularite'] == 0):?>
                                    <a href="<?=URI::get_path('product/popularok/'.$row['item_id'])?>" id="popularOk" class="btn btn-icon-only purple text-center">
                                        <i class="fa fa-star"></i>
                                    </a>
								<?php endif;?>
								<?php if($row['popularite'] == 1):?>
                                    <a href="<?=URI::get_path('product/popularno/'.$row['item_id'])?>" id="popularNo" class="btn btn-icon-only red text-center">
                                        <i class="fa fa-star-o"></i>
                                    </a>
								<?php endif;?>
                                <?php if($row['durum'] == 0):?>
                                    <a href="<?=URI::get_path('product/item_active/'.$row['item_id'])?>" id="itemActive" class="btn btn-icon-only green text-center">
                                        <i class="fa fa-check"></i>
                                    </a>
                                <?php endif;?>
                                <?php if($row['durum'] == 3):?>
                                    <a href="javascript:;" id="itemNo" class="btn btn-icon-only default text-center">
                                        <i class="fa fa-lock"></i>
                                    </a>
                                <?php endif;?>
                                <a href="<?=URI::get_path('product/itemdelete/'.$row['item_id'])?>" id="itemRemove" class="btn btn-icon-only dark text-center">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div></td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $("[id^=itemEdit]").mouseover(function () {
            $('#what').text('(Düzenle)');
            $('#what').css('color','#217ebd');
        });
        $("[id^=itemEdit]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=popularOk]").mouseover(function () {
            $('#what').text('(Sevilen)');
            $('#what').css('color','#2f353b');
        });
        $("[id^=popularOk]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=popularNo]").mouseover(function () {
            $('#what').text('(Sevilen Çıkar)');
            $('#what').css('color','#2f353b');
        });
        $("[id^=popularNo]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=itemDiscountOk]").mouseover(function () {
            $('#what').text('(İndirim)');
            $('#what').css('color','#e02612');
        });
        $("[id^=itemDiscountOk]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=itemRemove]").mouseover(function () {
            $('#what').text('(Sil)');
            $('#what').css('color','#181c1f');
        });
        $("[id^=itemRemove]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=itemActive]").mouseover(function () {
            $('#what').text('(Aktif Yap)');
            $('#what').css('color','#26a1ab');
        });
        $("[id^=itemActive]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=itemDiscountNo]").mouseover(function () {
            $('#what').text('(İndirimi Kaldır)');
            $('#what').css('color','#703688');
        });
        $("[id^=itemDiscountNo]").mouseout(function () {
            $('#what').text('');
        });
        $("[id^=itemNo]").mouseover(function () {
            $('#what').text('(İşlem Yok)');
            $('#what').css('color','#181c1f');
        });
        $("[id^=itemDiscountNo]").mouseout(function () {
            $('#what').text('');
        });
    });
</script>
<?php endif;?>