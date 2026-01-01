
<div class="col-md-3">
    <div class="col-md-12 no-padding-all">
        <div class="list-group news">
            <div class="subspot-link-bg">
                <a href="<?=\StaticDatabase\StaticDatabase::settings('tanitim');?>" class="subspot-link-image donate-link">
                    <br><?=$lng[174]?> <br><br>
                </a>
            </div>
            <div class="subspot-link-bg">
                <a href="<?=\StaticDatabase\StaticDatabase::settings('forum')?>" class="subspot-link-image donate-links">
                    <br><?=$lng[14]?> <br><br>
                </a>
            </div>
            <div class="subspot-link-bg">
                <a href="<?=\StaticDatabase\StaticDatabase::settings('facebook')?>" class="btn btn-block btn-social btn-facebook">
                    <span class="fa fa-facebook"></span> Facebook
                </a>
            </div>
            <div class="subspot-link-bg">
                <a href="<?=\StaticDatabase\StaticDatabase::settings('youtube')?>" class="btn btn-block btn-social btn-google">
                    <span class="fa fa-youtube"></span> YouTube
                </a>
            </div>


            <div class="unique-times">
                <ul id="myTab" class="nav nav-pills sub-spot-title-list">
                    <li class="sub-spot-title">
                        <h4><?=$lng[15]?></h4>
                    </li>
                </ul>
                <div class="center-block">
					<?php if(\StaticDatabase\StaticDatabase::settings('event_type') == "1"):?>
                        <iframe src="<?=URI::get_path('event')?>" style="border: none;width: 140px;height: 275px;margin-right: auto;margin-left: auto;margin-top: 20px" id="fancybox-frame"></iframe>
					<?php else:?>
                        <iframe src="<?=URI::get_path('event/dynamic')?>" style="border: none;width: 273px; height: 301px;left: 0px;" id="fancybox-frame"></iframe>
					<?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>