<style>
    .ticket-not
    {
        position: fixed;
        margin-left: 2%;
    }
</style>
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
function notificationConvert($value)
{
    if ($value === 'filter')
        return "Lütfen özel karakter kullanmayınız!";
    elseif ($value === 'empty')
        return "Ticket mevcut değil!";
    elseif ($value === 'lengt')
        return "Attığınız mesaj minimum 10 karakterden oluşmalıdır!";
    elseif ($value === 'time')
        return "5 dakika ara ile ticket gönderebilirsiniz!";
}
?>
<?php $sessionResult = isset($_SESSION['tNoty']) ? $_SESSION['tNoty'] : null; ?>
<?php if ($sessionResult === "true"):?>
    <div id="ticket_notification" class="alert alert-success ticket-not">Ticket yöneticiye iletildi.</div>
	<?php unset($_SESSION['tNoty']);?>
<?php elseif($sessionResult === null):?>
<?php else:?>
    <div id="ticket_notification" class="alert alert-error ticket-not"><?=notificationConvert($sessionResult)?></div>
	<?php unset($_SESSION['tNoty']);?>
<?php endif;?>
<div class="content clearfix" id="wt_refpoint">
    <div id="scroll" class="scrollable_container"  style="margin-top: 30px;">
        <div class="inside_scrollable_container" >
            <div class="center">
				<?php if (count($this->view) > 0):?>
					<?php foreach ($this->view as $key=>$row):?>
						<?php if ($row['divs'] == 'user'):?>
                            <div class="user-text">
                                <span class="message-who"><?= $row['username']?></span>
                                <span class="message-date"><?= $row['tarih'];?></span>
                                <div class="breadcrumbs"></div>
                                <span class="message"><?= find_url($row['message'])?></span>
                            </div>
						<?php else: ?>
                            <div class="admin-text">
                                <span class="message-who"><?= $row['username']?></span>
                                <span class="message-date"><?= $row['tarih'];?></span>
                                <div class="breadcrumbs"></div>
                                <span class="message"><?= find_url($row['message'])?></span>
                            </div>

						<?php endif;?>
					<?php endforeach;?>
				<?php endif;?>
            </div>
        </div>
    </div>
    <div class="message-input">
        <div class="send-box">
            <form action="<?=URI::get_path('ticket/send/'.$_url[3]);?>" method="post">
            <input type="text" name="message" placeholder="Mesajınızı Yazınız..." style="width: 75%" autocomplete="off">
            <button class="btn-default btn-send" type="submit">Gönder</button>
            </form>
        </div>
    </div>

</div>
<script>
    setTimeout(function () {
       $('#ticket_notification').fadeOut();
    },2000)
</script>
<?php
die;
    $token = md5(\StaticDatabase\StaticDatabase::settings('tokenkey').$aid.$_url[3]);
    Session::init();
    $tNoty = Session::get('tNoty');
    if ($tNoty == 'empty'){
        echo "<script>notfy('error','Boş mesaj gönderemezsiniz.')</script>";
        Session::set('tNoty',false);
    }elseif($tNoty == 'lengt'){
        echo "<script>notfy('error','Mesaj içeriği en az 10 karakter olmalıdır.')</script>";
        Session::set('tNoty',false);
    }elseif ($tNoty == 'time'){
        echo "<script>notfy('error','Son tickettan 1 dakika sonra tekrar gönderebilirsiniz.')</script>";
        Session::set('tNoty',false);
    }elseif($tNoty == 'ok'){
        echo "<script>notfy('success','Ticket gönderildi.')</script>";
        Session::set('tNoty',false);
    }elseif($tNoty == 'filter'){
        echo "<script>notfy('error','Hata')</script>";
        Session::set('tNoty',false);
    }
?>
<div class="page-title">
    <h2><span class="fa fa-comments"></span> Ticket Konuşması</h2>
</div>
<style>
    header
    {
        font-family: 'Lobster', cursive;
        text-align: center;
        font-size: 25px;
    }

    #info
    {
        font-size: 18px;
        color: #555;
        text-align: center;
        margin-bottom: 25px;
    }

    a{
        color: #074E8C;
    }

    .scrollbar
    {
        float: left;
        height: 700px;
        background: #F5F5F5;
        overflow-y: scroll;
    }


    #wrapper
    {
        text-align: center;
        width: 500px;
        margin: auto;
    }

    /*
     *  STYLE 4
     */

    #style-4::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
    }

    #style-4::-webkit-scrollbar
    {
        width: 10px;
        background-color: #F5F5F5;
    }

    #style-4::-webkit-scrollbar-thumb
    {
        background-color: #000000;
        border: 2px solid #555555;
    }

</style>

<div class="content-frame">
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="pull-right">
            <a href="<?=URI::get_path('ticket/close/'.$_url[3].'&token='.$token)?>"><button class="btn btn-primary"><span class="fa fa-times"></span> Ticket'ı Kapat</button></a>
        </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <!-- START CONTENT FRAME BODY -->
    <div class="row">
        <div id="wrapper">
        </div>
        <div class="clearfix" style="margin-bottom: 50px;"></div>
        <div class="col-md-12 scrollbar" id="style-4">
        <div class="messages messages-img">

        </div>
        </div>
        <div class="panel panel-default push-up-10">
            <form action="<?=URI::get_path('ticket/send/'.$_url[3].'&token='.$token);?>" method="post">
            <div class="panel-body panel-body-search">
                <div class="input-group">
                    <input type="text" class="form-control"  name="message" placeholder="Mesajınızı Yazınız..."/>
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">Gönder</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- END CONTENT FRAME BODY -->
</div>