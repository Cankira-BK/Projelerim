<?php
    /**
     * Created by PhpStorm.
     * User: User
     * Date: 16.11.2016
     * Time: 20:01
     */
    $result = $this->search['result'];
?>
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-search font-red"></i>
            <span class="caption-subject font-red sbold">Arama Sonuçları</span>
        </div>
    </div>
    <div class="portlet-body">
        <div id="tiles" class="tiles">
            <?php if ($result == false): ?>
                Böyle bir eşya bulunamadı.
            <?php elseif ($result == true):?>
                <?php foreach ($this->search['items'] as $product): ?>
                    <?php $url = $product['vnum'];?>
                    <button onclick="window.location.href='item/<?=$url;?>'" class="tile bg-blue-steel" style="width: 149px!important;">
                        <div class="tile-body img-responsive">
                            <?php $file = "./data/items/".Functions::itemToPng($product['vnum']);?>
                            <?php if(file_exists($file)):?>
                                <img src="<?=URL.'data/items/'.Functions::itemToPng($product['vnum']);?>" style="margin-left: 35px;" alt="İnspina Market Paneli" class="img-responsive" />
                            <?php else:?>
                                <img src="<?=URL.'data/items/60001.png'?>" style="margin-left: 35px;" alt="İnspina Market Paneli" class="img-responsive" />
                            <?php endif;?>
                        </div>
                        <div class="tile-object text-center">
                            <div class="name" style="position: absolute;bottom: 0;left: 0;right: 0;min-height: 30px;"> <?=Functions::utf8($product['locale_name']);?></div>
                        </div>
                    </button>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
    </div>
</div>
