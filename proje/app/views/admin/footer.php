</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<div class="page-footer">
    <div class="page-footer-inner" style="float: right;">
        <span> <a href="<?=\StaticDatabase\StaticDatabase::settings('footer_link')?>"> <?=\StaticDatabase\StaticDatabase::settings('footer_name')?> </a> Tarafından Geliştirilmiştir. 2020®</span>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
    <?php
        Session::init();
        $adId = Session::get('adId');
    $tCount = \StaticDatabase\StaticDatabase::init()->prepare("SELECT count FROM ticket_count WHERE id = '1'");
    $tCount->execute();
    $tCount->setFetchMode(PDO::FETCH_ASSOC);
    $tCounts = $tCount->fetch()['count'];
    $realtime = \StaticDatabase\StaticDatabase::settings('realtime');
    $ticketUrl = URI::get_path('ticket/realtime');
    ?>
    <div id="ticketCount" style="display: none"><?=$tCounts?></div>
</div>
<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->
<div class="quick-nav-overlay"></div>
<!-- END QUICK NAV -->

<script>
    // request permission on page load
    document.addEventListener('DOMContentLoaded', function () {
        if (Notification.permission !== "granted")
            Notification.requestPermission();
    });

    function notifyMe(url) {
        if (!Notification) {
            alert('Desktop notifications not available in your browser. Try Chromium.');
            return;
        }

        if (Notification.permission !== "granted")
            Notification.requestPermission();
        else {
            var notification = new Notification('<?=\StaticDatabase\StaticDatabase::settings('footer_name')?> Bildirim', {
                icon: '<?=URI::public_path()?>layouts/layout/img/logo.png',
                body: "1 adet yeni ticket ! Gitmek için bu panele tıklayınız.",
            });

            notification.onclick = function () {
                window.open(url);
            };

        }

    }
</script>

<script>
    $(document).ready(function () {
       var realtime = "<?=$realtime?>";
       if (realtime == '1'){
           setInterval(function () {
               var tCount = $('#ticketCount').text();
               var url = "<?php echo $ticketUrl;?>";
               $.post(url,{tCount:tCount},function (rsp) {
                   if(rsp.result == true){
                       $('#ticketCount').text(rsp.data[1]);
                       var ticketUrl = "<?=URI::get_path('ticket/view/')?>";
                       notify('information','Bir adet yeni ticket <br><a href="'+ ticketUrl + rsp.data[0]+'">Gitmek İçin Tıkla</a>');
                       console.log(rsp);
                       notifyMe(ticketUrl + rsp.data[0]);
                   }
               },"json");
           }, 3000);
       }
    });
</script>

<?php if (\StaticDatabase\StaticDatabase::settings('payreks_notification_status') == "1"):?>
    <script type="text/javascript" src="https://notification.payreks.org:3729/socket.io/socket.io.js"></script>
    <script type="text/javascript">
        var notificationToken = "<?php echo \StaticDatabase\StaticDatabase::settings('payreks_notification_token')?>";
        (function(){
            var head = document.head;
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.src = "https://development.payreks.com/assets/js/notificationEmbed.js";
            head.appendChild(script);
        })();
    </script>
<?php endif;?>


<!-- BEGIN CORE PLUGINS -->
<script src="<?=URI::public_path('')?>global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<?=Javascript::get().PHP_EOL;?>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?=URI::public_path('')?>global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?=Javascript::get2().PHP_EOL;?>
<!-- END PAGE LEVEL SCRIPTS -->
<?php
    $url = isset($_GET['url']) ? filter_var($_GET['url'],FILTER_SANITIZE_URL) : null;
    $url = rtrim($url, '/');
    $url = filter_var($url, FILTER_SANITIZE_URL);
    $_url = explode('/', $url);
?>
<?php if ($_url[1] == 'index'):?>
<script>
    var Dashboard = function () {
        return {
            initJQVMAP: function () {
                if (jQuery().vectorMap) {
                    var e = function (e) {
                        jQuery(".vmaps").hide(), jQuery("#vmap_" + e).show()
                    }, t = function (e) {
                        var t = jQuery("#vmap_" + e);
                        if (1 === t.size()) {
                            var a = {
                                map: "world_en",
                                backgroundColor: null,
                                borderColor: "#333333",
                                borderOpacity: .5,
                                borderWidth: 1,
                                color: "#c6c6c6",
                                enableZoom: !0,
                                hoverColor: "#c9dfaf",
                                hoverOpacity: null,
                                values: sample_data,
                                normalizeFunction: "linear",
                                scaleColors: ["#b6da93", "#909cae"],
                                selectedColor: "#c9dfaf",
                                selectedRegion: null,
                                showTooltip: !0,
                                onLabelShow: function (e, t, a) {
                                },
                                onRegionOver: function (e, t) {
                                    "ca" == t && e.preventDefault()
                                },
                                onRegionClick: function (e, t, a) {
                                    var i = 'You clicked "' + a + '" which has the code: ' + t.toUpperCase();
                                    alert(i)
                                }
                            };
                            a.map = e + "_en", t.width(t.parent().parent().width()), t.show(), t.vectorMap(a), t.hide()
                        }
                    };
                    t("world"), t("usa"), t("europe"), t("russia"), t("germany"), e("world"), jQuery("#regional_stat_world").click(function () {
                        e("world")
                    }), jQuery("#regional_stat_usa").click(function () {
                        e("usa")
                    }), jQuery("#regional_stat_europe").click(function () {
                        e("europe")
                    }), jQuery("#regional_stat_russia").click(function () {
                        e("russia")
                    }), jQuery("#regional_stat_germany").click(function () {
                        e("germany")
                    }), $("#region_statistics_loading").hide(), $("#region_statistics_content").show(), App.addResizeHandler(function () {
                        jQuery(".vmaps").each(function () {
                            var e = jQuery(this);
                            e.width(e.parent().width())
                        })
                    })
                }
            },  initAmChart4: function () {
                if ("undefined" != typeof AmCharts && 0 !== $("#dashboard_amchart_4").size()) {
                    var e = AmCharts.makeChart("dashboard_amchart_4", {
                        type: "pie",
                        theme: "light",
                        path: "../assets/global/plugins/amcharts/ammap/images/",
                        dataProvider: [
                            {country : "Mavi Bayrak", value: <?=$blue?>},
                            { country: "Sarı Bayrak", value: <?=$yellow?>},
                            {country: "Germany", value: 0},
                            {country: "Kırmızı Bayrak", value: <?=$red?>},
                        ],

                        valueField: "value",
                        titleField: "country",
                        outlineAlpha: .4,
                        depth3D: 15,
                        balloonText: "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                        angle: 30,
                        "export": {enabled: !0}
                    });
                    jQuery(".chart-input").off().on("input change", function () {
                        var t = jQuery(this).data("property"), a = e, i = Number(this.value);
                        e.startDuration = 0, "innerRadius" == t && (i += "%"), a[t] = i, e.validateNow()
                    })
                }
            },initAmChart5: function () {
                if ("undefined" != typeof AmCharts && 0 !== $("#dashboard_amchart_5").size()) {
                    var e = AmCharts.makeChart("dashboard_amchart_5", {
                        type: "pie",
                        theme: "light",
                        path: "../assets/global/plugins/amcharts/ammap/images/",
                        dataProvider: [
                            {country : "Savaşçı", value: <?=$warrior?>},
                            { country: "Ninja", value: <?=$ninja?>},
                            {country: "Sura", value: <?=$sura?>},
                            {country: "Şaman", value: <?=$shaman?>},
                            {country: "Lycan", value: <?=$lycan?>}
                        ],

                        valueField: "value",
                        titleField: "country",
                        outlineAlpha: .4,
                        depth3D: 15,
                        balloonText: "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                        angle: 30,
                        "export": {enabled: !0}
                    });
                    jQuery(".chart-input").off().on("input change", function () {
                        var t = jQuery(this).data("property"), a = e, i = Number(this.value);
                        e.startDuration = 0, "innerRadius" == t && (i += "%"), a[t] = i, e.validateNow()
                    })
                }
            } , init: function () {
                this.initJQVMAP(), this.initAmChart4(),this.initAmChart5()
            }
        }
    }();
    App.isAngularJsApp() === !1 && jQuery(document).ready(function () {
        Dashboard.init()
    });
</script>
<?php endif;?>


<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?=URI::public_path('')?>layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="<?=URI::public_path('')?>layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->
</body>

</html>
