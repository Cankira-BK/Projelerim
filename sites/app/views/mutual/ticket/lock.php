<div class="content clearfix" id="wt_refpoint">
    <h2 class="header-title">
        <ul class="breadcrumb">
            <li>
                <a href="#" title="En gözdeler">Kapatılmış Ticketlar</a>
                <span class="item_count"></span>
            </li>
        </ul>
    </h2>
    <div class="scrollable_container" style="margin-top: 30px;">
        <div class="inside_scrollable_container">
            <div class="center">
				<?php if (count($this->lock) === 0):?>
                    <div class="alert alert-error">Kapatılmış destek bildirimi bulunumadı!</div>
				<?php else:?>
                    <table class="ticket-list table table-hover">
                        <tbody>
                        <tr style="background: white;">
                            <th>#</th>
                            <th>Ticket id</th>
                            <th>Konu Başlığı</th>
                            <th>Mesaj</th>
                            <th>Tarih</th>
                        </tr>
						<?php foreach ($this->lock as $key=>$row): ?>
							<?php $messageC = strlen($row['message']);
							if ($messageC > 20 ){
								$message = substr($row['message'],0,15) . '...';
							}else{
								$message = $row['message'];
							}
							?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?='#'.$row['ticketid']?></td>
                                <td><?=$row['title']?></td>
                                <td><?=$message?></td>
                                <td><?=$row['tarih']?></td>
                            </tr>
						<?php endforeach;?>
                        </tbody>
                    </table>
				<?php endif;?>
            </div>
        </div>
    </div>
</div>

<?php die;?>
<!-- PAGE TITLE -->
<div class="page-title">
    <h2><span class="fa fa-send"></span> Yanıtlanmış Destek Bildirimleri</h2>
</div>
<!-- END PAGE TITLE -->

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">

            <!-- START DEFAULT DATATABLE -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Liste</h3>
                </div>
                <div class="panel-body">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ticket id</th>
                            <th>Konu Başlığı</th>
                            <th>Mesaj</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($this->lock as $key=>$row): ?>
                            <?php $messageC = strlen($row['message']);
                            if ($messageC > 20 ){
                                $message = substr($row['message'],0,15) . '...';
                            }else{
                                $message = $row['message'];
                            }
                            ?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?='#'.$row['ticketid']?></td>
                                <td><?=$row['title']?></td>
                                <td><?=$message?></td>
                                <td><?=$row['tarih']?></td>
                                <td><a href="javascript:void(0);"><button type="button" class="btn btn-primary fa fa-times" title="İncele" disabled="disabled"></button></a></td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END DEFAULT DATATABLE -->

        </div>
    </div>

</div>
<!-- PAGE CONTENT WRAPPER -->