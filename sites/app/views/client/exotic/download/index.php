<style>
    .col-50 {
        float: left;
        width: 50%;
        box-sizing: border-box;
    }
    .bg-light {
        margin-top: 50px;
        color: #A1865D;
    }
    .col-50 > strong{
        font-weight: 600;
    }
    .col-50 .title{
        color: #776255;
    }
</style>
<div style="float: left; width: 665px; margin-left:20px;">
    <div style="float: left; margin-top: 10px;">
        <div class="windows windows-wbTop"></div>
        <div class="windows windows-wbCenter">
            <div class="content" style="padding-left:20px; padding-right:20px;">
                <span class="title">İndirme Linkleri</span>
                <table id='large' cellspacing='0' class='tablesorter'>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?=$lng[52]?></th>
                        <th><?=$lng[53]?></th>
                        <th><?=$lng[54]?></th>
                        <th><?=$lng[55]?></th>
                    </tr></thead>
					<?php foreach ($this->pack as $key=>$row):?>
                        <tr>
                            <td width='5%'><?=($key+1)?></td>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['size'];?></td>
                            <td><img src="<?=$row['image']?>" alt="<?=\StaticDatabase\StaticDatabase::settings('oyun_adi')?>" width="70px"></td>
                            <td><a href="<?=$row['url']?>" target="_blank"><button  class="loginbt" style="height: 20px;">İndİr</button></a></td>
                        </tr>
					<?php endforeach;?>
                </table>
            </div>
        </div>
        <div class="windows windows-wbBottom"></div>
    </div>
</div>
