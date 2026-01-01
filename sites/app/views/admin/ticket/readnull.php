<?php
    if(Session::get('aNoty') == true){
        echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
        Session::set('aNoty',false);
    }
?>
<div class="row" style="margin-bottom: 25px;">
    <div class="col-md-12">
        <a href="<?=URI::get_path('ticket/readmy')?>" class="btn red text-center">
            Bana ait Ticketlar (Yanıtlanmamış)
        </a>
        <a href="<?=URI::get_path('ticket/readother')?>" class="btn blue text-center">
            Diğer Yöneticilere Ticketlar (Yanıtlanmış)
        </a>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Tüm Yanıtlanmamış Ticketlar</span>
                </div>
                <div class="tools"> </div>
            </div>

            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ticket İd</th>
                        <th>Oyuncu Adı</th>
                        <th>Başlık</th>
                        <th>Mesaj</th>
                        <th>Kimde</th>
                        <th>Tarih</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->readnull as $key=>$row):?>
                        <?php $messageC = strlen($row['message']);
                        if ($messageC > 20 ){
                            $message = substr($row['message'],0,15) . '...';
                        }else{
                            $message = $row['message'];
                        }
                        ?>
                        <tr>
                            <td><?=$key+1?></td>
                            <td>#<?=$row['ticketid'];?></td>
                            <td><?=$row['username'];?></td>
                            <td><?=$row['title'];?></td>
                            <td><?=$message?></td>
                            <td><span class="label label-sm label-danger"> Yönetici Atanmadı </span></td>
                            <td><?=$row['tarih'];?></td>
                            <td><div class="margin-bottom-5 text-center">
                                    <a href="<?=URI::get_path('ticket/view/'.$row['ticketid'])?>" class="btn btn-icon-only green text-center">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?=URI::get_path('ticket/close/'.$row['ticketid'])?>" class="btn btn-icon-only dark text-center">
                                        <i class="fa fa-lock"></i>
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