<div class="content clearfix" id="wt_refpoint">
    <h2 class="header-title">
        <ul class="breadcrumb">
            <li>
                <a href="#" title="En gözdeler">Yanıtlanmış Ticketlar</a>
                <span class="item_count"></span>
            </li>
        </ul>
    </h2>
    <div class="scrollable_container" style="margin-top: 30px;">
        <div class="inside_scrollable_container">
            <div class="center">
                <?php if (count($this->read) === 0):?>
                    <div class="alert alert-error">Yanıtlanmış destek bildirimi bulunumadı!</div>
                <?php else:?>
                    <table class="ticket-list table table-hover">
                        <tbody>
                        <tr style="background: white;">
                            <th>#</th>
                            <th>Ticket id</th>
                            <th>Konu Başlığı</th>
                            <th>Mesaj</th>
                            <th>Tarih</th>
                            <th>İşlem</th>
                        </tr>
						<?php foreach ($this->read as $key=>$row): ?>
							<?php $messageC = strlen($row['message']);
							if ($messageC > 20 ){
								$message = substr($row['message'],0,20) . '...';
							}else{
								$message = $row['message'];
							}
							?>
                            <tr>
                                <td><?=$key+1?></td>
                                <td><?='#'.$row['ticketid']?></td>
                                <td style="font-weight: 600;"><?=$row['title']?></td>
                                <td><?=$message?></td>
                                <td><?=$row['tarih']?></td>
                                <td>
                                    <a href="<?=URI::get_path('ticket/view/'.$row['ticketid'])?>"><button type="button" class="btn-default btn-ticket" title="İncele"><i class="zicon-hd-tradable"></i></button></a>
                                    <a href="<?=URI::get_path('ticket/close/read/'.$row['ticketid'])?>"><button type="button" class="btn-default btn-ticket" title="Kapat"><i class="zicon-hd-soldout"></i></button></a>
                                </td>
                            </tr>
						<?php endforeach;?>
                        </tbody>
                    </table>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>