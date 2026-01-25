<?php
Session::init();
if(Session::get('aLogin') == null){
	URI::redirect('login');
	exit();
}
$deleteCache = isset($_SESSION['delete_cache']) ? $_SESSION['delete_cache'] : null;
if ($deleteCache == true)
{
	echo '<script>$(document).ready(function() {
  notify("success","Tüm cacheler silindi !");
});</script>';
	unset($_SESSION['delete_cache']);
}
$PurgeCloudCache1 = isset($_SESSION['delete_cloud_cache']) ? $_SESSION['delete_cloud_cache'] : null;
if ($PurgeCloudCache1 == true)
{
	echo '<script>$(document).ready(function() {
  notify("success","CloudFlare Cacheleri silindi !");
});</script>';
	unset($_SESSION['delete_cloud_cache']);
}
$PurgeCloudCache2 = isset($_SESSION['delete_cloud_cache_error']) ? $_SESSION['delete_cloud_cache_error'] : null;
if ($PurgeCloudCache2 == true)
{
	echo '<script>$(document).ready(function() {
  notify("error","CloudFlare API bilgileri hatalı !");
});</script>';
	unset($_SESSION['delete_cloud_cache_error']);
}
$getIp = \StaticDatabase\StaticDatabase::settings('ip');
$getPassword = \StaticDatabase\StaticDatabase::settings('password');
$getUser = \StaticDatabase\StaticDatabase::settings('user');
$getDb = \StaticDatabase\StaticDatabase::settings('db');
$getDbKey = \StaticDatabase\StaticDatabase::settings('dbkey');
$GetTheme = \StaticDatabase\StaticDatabase::settings('client');
if ($getDbKey == ''){
	URI::redirect('setting/index');
	exit();
}elseif($getIp == '' || $getPassword == '' || $getUser == '' || $getDb == ''){
	URI::redirect('setting/index2');
	exit();
}
$adminId = Session::get('adId');
$getAdminInfo = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id,name,avatar,login FROM user WHERE id = ?");
$getAdminInfo->execute(array($adminId));
$getAdminInfo->setFetchMode(PDO::FETCH_ASSOC);
$getAdmin = $getAdminInfo->fetch();
$countMyTicket = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id FROM ticket_status WHERE whoid = ? AND status = ?");
$countMyTicket->execute(array($adminId,'1'));
$getFullTicket = \StaticDatabase\StaticDatabase::init()->prepare("SELECT ticketid,username,title,message,tarih,whoid FROM ticket_status WHERE status = ? ORDER BY tarih DESC");
$getFullTicket->execute(array('1'));
$getFullTicket->setFetchMode(PDO::FETCH_ASSOC);
$getTicket = $getFullTicket->fetchAll();
$getMyLogs = \StaticDatabase\StaticDatabase::init()->prepare("SELECT content,date FROM admin_log WHERE user_id = ? ORDER BY date DESC LIMIT 0,10");
$getMyLogs->execute(array($adminId));
$getMyLogs->setFetchMode(PDO::FETCH_ASSOC);
$getPermission = Session::get('aPermission');
?>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-content-white">
<!--Progress Start-->
<!--<div class="progresss" id="progresss"></div>-->
<!--Progress End-->
<div class="page-wrapper" >
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top">
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner ">
            <!-- BEGIN LOGO -->
            <div class="page-logo">
                <a href="<?=URI::get_path('index')?>">
                    <img src="<?=URI::public_path()?>layouts/layout/img/logo.png" alt="logo" class="logo-default" width="150px" style="margin-top: 10px;"/> </a>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
            <?php if ($_SESSION['aPermission'] > 97):?>
            <!-- END LOGO -->
            <form class="search-form search-form-expanded" action="<?=URI::get_path('account/search')?>" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="login" placeholder="Kullanıcı Adı ile Arama">
                    <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                </div>
            </form>
			<?php if (\StaticDatabase\StaticDatabase::systems('guvenlipc_durum') === "1"):?>
			<form class="search-form search-form-expanded" action="<?=URI::get_path('account/searchmac')?>" method="POST">
				<div class="input-group">
					<input type="text" class="form-control" name="mac" placeholder="MAC Adresi ile Arama">
					<span class="input-group-btn"><a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a></span>
				</div>
			</form>
			<?php endif;?>
            <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
            <form class="search-form search-form-expanded" action="<?=URI::get_path('player/search')?>" method="POST">
                <div class="input-group">
                    <input type="text" class="form-control" name="name" placeholder="Karakter Adı ile Arama">
                    <span class="input-group-btn">
                                <a href="javascript:;" class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                </div>
            </form>
			<?php endif;?>
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <!-- BEGIN TOP NAVIGATION MENU -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- BEGIN NOTIFICATION DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                    <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                    <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                    <?php if (\StaticDatabase\StaticDatabase::settings('cloud_status') === "1"):?>
					<li class="dropdown dropdown-extended">
                        <a href="<?=URI::get_path('log/deletecloudflarecache')?>" style=" padding: 19px 10px 10px;">
                            <i class="cloudflare-icon" style="color:#79869a;font-size: 17px;" title="CloudFlare Cacheleri Sil"></i>
                        </a>
                    </li>
					<?php endif;?>
					<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"18") == true):?>
					<li class="dropdown dropdown-extended">
                        <a href="<?=URI::get_path('log/deletecache')?>" style=" padding: 19px 10px 10px;">
                            <i class="icon-trash" style="color:#79869a;font-size: 17px;" title="Panel Cacheleri Sil"></i>
                        </a>
                    </li>
					<?php endif;?>
                    <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-calendar"></i>
                        </a>
                        <ul class="dropdown-menu" style="max-width: 500px;width: 500px;">
                            <li class="external">
                                <h3>
                                    Son <span class="bold">10</span> Log Kayıtı</h3>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
									<?php foreach ($getMyLogs->fetchAll() as $row):?>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="time"><?=Functions::zaman($row['date'])?></span>
                                                <span class="details">
                                                        <span class="label label-sm label-icon label-warning">
                                                            <i class="fa fa-calendar"></i>
                                                        </span><?=$row['content']?>nız</span>
                                            </a>
                                        </li>
									<?php endforeach;?>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- END NOTIFICATION DROPDOWN -->
                    <!-- BEGIN INBOX DROPDOWN -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"15") == true):?>
					<li class="dropdown dropdown-extended dropdown-inbox" id="header_inbox_bar">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <i class="icon-envelope-open"></i>
                            <span class="badge badge-default"> <?=count($getTicket);?> </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="external">
                                <h3>Toplam
                                    <span class="bold"><?=count($getTicket);?> Adet</span> Yeni Mesaj</h3>
                                <a href="<?=URI::get_path('ticket/unread')?>">Tümünü Gör</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 275px;" data-handle-color="#637283">
									<?php foreach ($getTicket as $row):?>
										<?php $messageC = strlen($row['message']);
										if ($messageC > 101 ){
											$message = substr($row['message'],0,100) . '...';
										}else{
											$message = $row['message'];
										}
										?>
                                        <li>
                                            <a href="<?=URI::get_path('ticket/view/'.$row['ticketid'])?>">
                                                    <span class="photo">
                                                        <img src="<?=URL?>data/upload/no-image.jpg" class="img-circle" alt=""> </span>
                                                <span class="subject">
                                                        <span class="from"> <?=$row['username']?> </span>
                                                        <span class="time"><?=Functions::zaman($row['tarih'])?> </span>
                                                    </span>
                                                <span class="message"> <?=$message?> </span>
                                            </a>
                                        </li>
									<?php endforeach;?>
                                </ul>
                            </li>
                        </ul>
                    </li>
					<?php endif;?>
                    <!-- END INBOX DROPDOWN -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?=URL.$getAdmin['avatar']?>" onerror="this.src = '<?=URL?>data/upload/no-image.jpg';"/>
                            <span class="username username-hide-on-mobile"> <?=$getAdmin['name']?> </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="<?=URI::get_path('profile/index')?>">
                                    <i class="icon-user"></i> Hesabım </a>
                            </li>
                            <li>
                                <a href="<?=URI::get_path('ticket/unreadmy')?>">
                                    <i class="icon-envelope-open"></i> Gelen Kutusu
                                    <span class="badge badge-danger"> <?=$countMyTicket->rowCount()?> </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="<?=URI::get_path('login')?>">
                                    <i class="icon-key"></i> Çıkış Yap </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <!-- BEGIN SIDEBAR -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <div class="page-sidebar navbar-collapse collapse">
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="500">
                    <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                    <li class="sidebar-toggler-wrapper hide">
                        <div class="sidebar-toggler">
                            <span></span>
                        </div>
                    </li>
                    <!-- END SIDEBAR TOGGLER BUTTON -->
					<?php
					function getUri(){
						$_url = filter_var($_GET['url'],FILTER_SANITIZE_URL);
						$_url = rtrim($_url, '/');
						$_url = filter_var($_url, FILTER_SANITIZE_URL);
						$_url = explode('/',$_url);
						if(empty($_url[1])){
							$result = $_url;
							$result[1] = "index";
						}else{
							$result = $_url;
						}
						return $result;
					}
					?>
					<?php $getMainMenu = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM menu WHERE status = :status");
					$getMainMenu->execute(array(':status'=>0));
					$getMainMenu->setFetchMode(PDO::FETCH_ASSOC);
					?>
					<?php foreach ($getMainMenu->fetchAll() as $key=>$row):?>
						<?php $checkPermission = Functions::checkPermissionMenu(Session::get('aPermissionArray'),$row['link']);?>
						<?php if ($checkPermission == true):?>
                            <li class="nav-item
                         <?php if ($row['link'] == getUri()[1]): ?>
                          start open active
                          <?php endif;?>
                           ">
                                <a href="<?php if ($row['alone'] == 1):?>javascript:;<?php elseif ($row['alone'] == 0):?><?=URI::get_path($row['link'])?><?php endif;?>" class="nav-link nav-toggle">
                                    <i class="fa fa-<?=$row['icon']?>"></i>
                                    <span class="title"><?=$row['name']?></span>
                                    <span class="selected"></span>
                                    <span class="arrow
                                <?php if ($row['link'] == getUri()[1]): ?>
                                open
                                <?php endif;?>
                                "></span>
                                </a>
								<?php
								$mainId = $row['id'];
								$getSubMenu = \StaticDatabase\StaticDatabase::init()->prepare("SELECT * FROM menu WHERE mainmenu = '$mainId'");
								$getSubMenu->execute();
								$getSubMenu->setFetchMode(PDO::FETCH_ASSOC);
								$subMenu = $getSubMenu->fetchAll();
								?>
								<?php if ($subMenu != null):?>
                                    <ul class="sub-menu">
										<?php foreach ($subMenu as $keySub => $rowSub):?>
											<?php if (in_array($rowSub['permission'],Session::get('allPermissionArray')) == true):?>
                                                <li class="nav-item
                                         <?php
												$subMenuControl = isset(getUri()[2]) ? getUri()[2] : null;
												if (isset($subMenuControl)){
													$subMenus = getUri()[1].'/'.getUri()[2];
												}else{
													$subMenus = getUri()[1];
												}
												?>
                                 <?php if ($rowSub['link'] == $subMenus):?>
                                  start open active
                                  <?php endif;?>
                                  ">
                                                    <a href="<?=URI::get_path($rowSub['link'])?>" class="nav-link ">
                                                        <i class="fa fa-<?=$rowSub['icon']?>"></i>
                                                        <span class="title"><?=$rowSub['name']?></span>
                                                        <span class="selected"></span>
														<?php if(isset($rowSub['other'])):?>
                                                            <span class="badge badge-danger"><?=$rowSub['other']?></span>
														<?php endif;?>
                                                    </a>
                                                </li>
											<?php endif;?>
										<?php endforeach;?>
                                    </ul>
								<?php endif;?>
                            </li>
						<?php endif;?>
					<?php endforeach;?>
                </ul>
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->
        <script>
            function date_time(id)
            {
                var date = new Date;
                var year = date.getFullYear();
                var month = date.getMonth();
                var months = new Array('Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık');
                var d = date.getDate();
                var day = date.getDay();
                var days = new Array('Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi');
                var h = date.getHours();
                if(h<10)
                {
                    h = "0"+h;
                }
                var m = date.getMinutes();
                if(m<10)
                {
                    m = "0"+m;
                }
                var s = date.getSeconds();
                if(s<10)
                {
                    s = "0"+s;
                }
                var result = d+' '+months[month]+' '+year+' ['+days[day]+'] - '+h+':'+m+':'+s;
                document.getElementById(id).innerHTML = result;
                setTimeout('date_time("'+id+'");','1000');
                return true;
            }
        </script>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="<?=URI::get_path('index');?>">Anasayfa</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span><?=\StaticDatabase\StaticDatabase::settings('footer_name')?> Yönetim Paneli</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Tarih">&nbsp;
                            <span id="date_time"></span>
                            <script type="text/javascript">
                                date_time('date_time');
                            </script>
                        </div>
                        <div class="pull-right btn btn-sm">&nbsp;
                        </div>
                    </div>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h1 class="page-title"></h1>
                <!-- END PAGE TITLE-->