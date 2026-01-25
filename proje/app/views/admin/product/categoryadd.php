<div class="row">
    <?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"7") == true):?>
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-barcode font-green"></i>
                    <span class="caption-subject bold uppercase"> Üst(Ana) Kategori Oluştur</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="categoryCreate" role="form" action="<?=URI::get_path('product/categoryaddok');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="categoryName" name="name" class="form-control" required>
                            <input type="hidden" name="what" value="main" class="form-control" >
                            <label for="form_control_1">Kategori İsmi</label>
                            <span class="help-block">Oluştumak İstediğiniz Kategori İsmini Giriniz...</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="categoryNamex" name="icon" class="form-control" required>
                            <label for="form_control_1">Kategori Resim Linki</label>
                            <span class="help-block">Buraya resim link'i giriniz: Örn: https://gf3.geo.gfsrv.net/cdn29/23b5f848f1a0b324f6e3c3d3564130.png </span>
                        </div>
                        <div class="md-checkbox-list">
                            <div class="md-checkbox has-info">
                                <input type="hidden" name="alone" class="md-check" value="1">
                                <input type="checkbox" name="alone" id="checkbox2" class="md-check" value="0" >
                                <label for="checkbox2">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span><i style="color: red;" id="checkbox2Text"> Oluşturacağınız bu kategorinin alt kategorisi <u style="color: black">olmayacaksa</u> bu bölümü işaretleyiniz. </i> </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" name="main" class="btn blue">Kategori Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-barcode font-green"></i>
                    <span class="caption-subject bold uppercase"> Alt Kategori Oluştur</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="categoryCreates" role="form" action="<?=URI::get_path('product/categoryaddok');?>" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <select class="table-group-action-input form-control input-xlarge" name="mainCategory">
                                <?php
                                    $kate = \StaticDatabase\StaticDatabase::init()->prepare("SELECT id,name FROM shop_menu WHERE  mainmenu = :mainmenu");
                                    $kate->execute(array(':mainmenu'=>'0'));
                                    $kate->setFetchMode(PDO::FETCH_ASSOC);
                                    $katet = $kate->fetchAll();
                                ?>
                                <?php foreach ($katet as $rowss):?>
                                    <option value="<?=$rowss['id']?>"><?=$rowss['name']?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="text" id="categoryNames" name="name" class="form-control" required>
                            <label for="form_control_1">Kategori İsmi</label>
                            <input type="hidden" name="what" value="sub" class="form-control" >
                            <span class="help-block">Oluştumak İstediğiniz Kategori İsmini Giriniz...</span>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" name="sub" class="btn blue">Kategori Oluştur</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
    <?php endif;?>
</div>
<script>
    $(document).ready(function () {
        $('#categoryCreate').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var link = $(this).attr('action');
            $.post(link,data,function () {
                notify('success',"Kategori Oluşturuldu!");
                $('#categoryName').val('');
                $('#categoryNamex').val('');
            });
        });
        $('#categoryCreates').submit(function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            var link = $(this).attr('action');
            $.post(link,data,function () {
                notify('success',"Kategori Oluşturuldu!");
                $('#categoryName').val('');
                $('#categoryNamex').val('');
            });
        });
    });
</script>