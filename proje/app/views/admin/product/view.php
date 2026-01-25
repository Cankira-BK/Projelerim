<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"3") == true):?>
<?php $rowCount = $this->view['count']; ?>
<div id="roro" style="display: none"><?= $rowCount;?></div>
<div id="rorox" style="display: none">0</div>

<div class="clearfix"></div>

<div class="portlet light bordered">
    <div class="search-bar" style="position: fixed!important; display: inline-block; z-index:1">
        <div class="row">
            <div class="col-md-3" style="float: right;">
                <div class="input-group" style="float: right;margin-top: -93px;">
                    <span class="input-group-btn">
                        <a id="roroc" class="btn dark uppercase bold" style="float: right;" > <?= $rowCount;?></a>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="portlet-title">
        <div class="caption">
            <i class="glyphicon glyphicon-shopping-cart font-red"></i>
            <span class="caption-subject font-red sbold">Nesne Markete Eşya Ekle</span>
        </div>
    </div>
    <div class="portlet-body">
        <div class="search-bar" style="margin-top: 30px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="input-group">
                        <select class="form-control edited" id="itemList">
							<?php foreach ($this->view['list'] as $row):?>
                                <?php if ($row['vnum'] > 2):?>
                                    <option value="<?=$row['vnum']?>"><?=Functions::utf8($row['locale_name'])?></option>
								<?php endif;?>
							<?php endforeach;?>
                        </select>
                        <span class="input-group-btn">
                            <a id="itemListHref" href="<?=URI::get_path('product/item/10')?>" class="btn blue uppercase bold">Git</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix" style="margin-top: 30px;"></div>

        <div class="search-bar" style="margin-bottom: 30px">
            <div class="row">
                <div class="col-md-12">
                    <form action="<?=URI::get_path('product/search')?>" method="POST">
                        <div class="input-group">
                            <input type="text" name="searchValue" class="col-md-12 form-control" placeholder="Vnum ile ara"> </p>
                            <span class="input-group-btn">
                                                <button class="btn blue uppercase bold" type="submit">Eşya Ara</button>
                                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="tiles" class="tiles">
            <?php foreach ($this->view['result'] as $product): ?>
                <?php $url = $product['vnum'];?>
                <button onclick="window.location.href='item/<?= $url;?>'" class="tile bg-blue-steel" style="width: 149px!important;">
                    <div class="tile-body img-responsive">



                            <img src="<?=URL.'data/items/'.Functions::itemToPng($product['vnum']);?>" style="margin-left: 35px;" alt="İnspina Market Paneli" class="img-responsive" />

                    </div>
                    <div class="tile-object text-center">
                        <div class="name" style="position: absolute;bottom: 0;left: 0;right: 0;min-height: 30px;"> <?=Functions::utf8($product['locale_name']);?></div>
                    </div>
                </button>
            <?php endforeach; ?>

        </div>
    </div>
    <div id="loadingIcon" class="text-center"> <img src="<?=URL.'data/items/LoaderIcon.gif'?>"></div>
    <div class="modal fade draggable-modal" id="draggable" tabindex="-1" role="basic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Eşya Ara</h4>
                </div>
                <form action="<?=URI::get_path('product/search')?>" method="POST">
                    <div class="modal-body">
                        <div class="scroller" data-always-visible="1" data-rail-visible1="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Aramak İstedğiniz Eşyanın Vnum Kodu'unu Yazınız...</h4>
                                    <p>
                                        <input type="text" name="searchValue" class="col-md-12 form-control"> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn dark btn-outline" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn green">Eşya Ara</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<script type="text/javascript" charset="utf-8">

    $(document).ready(function () {
        $('#loadingIcon').hide();
        $('#searchButton').click(function () {
            $('#searchInput').show();
            $('#searchButton2').show();
        });
        $('#searchButton2').click(function () {
            $('#searchInput').hide();
            $('#searchButton2').hide();
        });
        function getresult(url) {
            $.ajax({
                url: url,
                type: "POST",
                data:  {rowcount:$("#roro").text()},
                beforeSend: function(){
                    $('#loadingIcon').show();
                    $('#rorox').text('1');
                },
                complete: function(){
                    $('#loadingIcon').hide();
                },
                success: function(data){
//                    console.log(data);
                    $('#rorox').text('0');
                    $("#tiles").append(data);
                    var getroro = parseInt($('#roro').text()) + 96;
//                    alert(getroro);
                    var strr = getroro.toString();
                    $('#roro').text(strr);
                    $('#roroc').text(strr);

                },
                error: function(){}
            });
        }
        $(window).scroll(function () {
            var getrorox = parseInt($('#rorox').text());
            if ($(window).scrollTop() == $(document).height() - $(window).height()){
                if(getrorox == 0){
                    var uri = "<?php echo URI::get_path('product/getview');?>";
                    getresult(uri);
                }
            }
        });
    });
    $('#itemList').change(function () {
       var data = $(this).val();
       $('#itemListHref').attr('href',"<?=URI::get_path('product/item/')?>" + data);
    });
</script>
<?php endif;?>