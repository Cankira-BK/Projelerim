<?php
    function find_url($string){
//"www."
        $pattern_preg1 = '#(^|\s)(www|WWW)\.([^\s<>\.]+)\.([^\s\n<>]+)#sm';
        $replace_preg1 = '\\1<a href="http://\\2.\\3.\\4" target="_blank" class="link">\\2.\\3.\\4</a>';

//"http://"
        $pattern_preg2 = '#(^|[^\"=\]]{1})(http|HTTP|ftp)(s|S)?://([^\s<>\.]+)\.([^\s<>]+)#sm';
        $replace_preg2 = '\\1<a href="\\2\\3://\\4.\\5" target="_blank" class="link">\\2\\3://\\4.\\5</a>';

        $string = preg_replace($pattern_preg1, $replace_preg1, $string);
        $string = preg_replace($pattern_preg2, $replace_preg2, $string);

        return $string;
    }
    $stat = $this->view['status'][0];
    date_default_timezone_set('Europe/Istanbul');
    $accountID = isset($this->view['all'][0]['accountid']) ? $this->view['all'][0]['accountid'] : 0;
    $getBan = \StaticGame\StaticGame::sql("SELECT ticket_ban FROM ".ACCOUNT_DB_NAME.".account WHERE id = ?",[$accountID])[0]['ticket_ban'];
?>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart font-dark hide"></i>
                    <span class="caption-subject font-dark bold uppercase"><?=$stat['title']?></span>

                </div>
                <div class="inputs">
                    <span class="caption-helper" style="font-size: 25px;"><span class="badge badge-empty badge-danger"></span> <?php if ($stat['whoname'] == null){echo 'Yönetici Atanmadı';}else{echo 'Admin :'.$stat['whoname'];}?></span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="general-item-list" id="general-list">
                    <?php foreach ($this->view['all'] as $row):?>
                        <?php if ($row['first'] == '1'):?>
                            <div class="item">
                                <div class="item-head">
                                    <?php if ($_SESSION['aPermission'] > 97):?>
                                        <a href="<?=URI::get_path('account/account/'.$accountID)?>" class="btn btn-success">Hesabı İncele</a>
									<?php endif;?>
                                    <?php if ($getBan):?>
                                        <a href="<?=URI::get_path('ticket/ban_open/'.$accountID)?>" class="btn btn-danger">Ticket Ban Aç</a>
									<?php else:?>
                                        <a href="<?=URI::get_path('ticket/ban/'.$accountID)?>" class="btn btn-danger">Ticket BAN</a>
									<?php endif;?>
                                    <a href="<?=URI::get_path('ticket/close/'.$stat['ticketid'])?>" class="btn btn-danger">Ticket Kapat</a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="item-head">
                                    <div class="item-details">

                                        <div style="border-style: groove;" class="col-md-12">
                                            <a href="javascript:void(0);" class="item-name primary-link"></a>
                                            <div class="item-body"><?=find_url($row['message'])?> </div>
                                        </div>
                                    </div>
                                    <span class="item-status">
                                        <span class="badge badge-empty badge-primary"></span> <?=$row['tarih']?></span>
                                </div>
                            </div>
                        <?php else:?>
                            <?php if ($row['divs'] == 'user'):?>
                                <div class="item">
                                    <div class="item-head">
                                        <div class="item-details">
                                            <img class="item-pic rounded" src="<?=URL?>data/upload/no-image.jpg">
                                            <a href="" class="item-name primary-link"><?=$row['username']?></a>
                                            <span class="item-label"></span>
                                        </div>
                                        <span class="item-status">
                                                            <span class="badge badge-empty badge-success"></span> <?=$row['tarih']?></span>
                                    </div>
                                    <div class="item-body"> <?=find_url($row['message'])?> </div>
                                </div>
                            <?php elseif ($row['divs'] == 'admin'):?>
                                <div class="item">
                                    <div class="item-head">
                                        <div class="item-details">
                                            <img class="item-pic rounded" src="<?=URL.$getAdmin['avatar']?>" onerror="this.src = '<?=URL?>data/upload/no-image.jpg';">
                                            <a href="" class="item-name primary-link"><?=$row['username']?></a>
                                            <span class="item-label"></span>
                                        </div>
                                        <span class="item-status">
                                                            <span class="badge badge-empty badge-warning"></span> <?=$row['tarih']?></span>
                                    </div>
                                    <div class="item-body"> <?=find_url($row['message'])?> </div>
                                </div>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endforeach;?>
                        <div class="append" id="append">

                        </div>
                    </div>
            </div>
            <form role="form" id="newsCreate" action="<?=URI::get_path('ticket/send/'.$stat['ticketid'])?>" method="post" enctype="multipart/form-data">
            <div class="portlet-body form" style="margin-top: 15px;">
                <div class="form-body">
                    <div class="form-group form-md-line-input" style="margin-bottom: 1px;">
						<input type="hidden" name="ticketid" value="<?=$stat['ticketid'];?>">
						<input type="hidden" name="accountid" value="<?=$stat['accountid'];?>">
						<input type="hidden" name="username" value="<?=$stat['username'];?>">
						<input type="hidden" name="title" value="<?=$stat['title'];?>">
                        <textarea class="input-block-level" id="summernote_1" name="message" rows="4" placeholder="Bir mesaj yaz..."></textarea>
                    </div>
					<button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                        <span class="ladda-label">Cevapla</span>
					</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
    Session::init();
    $aName = Session::get('aName');
    $date = date("Y-m-d H:i:s");
?>
<script>
    $('#newsCreate').submit(function (eve) {
        eve.preventDefault();
        var url = $(this).attr('action');
        var data = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                console.log(result);
                if (result.result === true)
                    notify('success','Mesajınız Başarıyla Eklendi!');
                else
                    notify('error','Lütfen mesajınızı yazınız!');
            }
        });
    });
</script>