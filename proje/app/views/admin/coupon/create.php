<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"10") == true):?>
<div class="row">
    <div class="col-md-12 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-barcode font-green"></i>
                    <span class="caption-subject bold uppercase"> Kupon Oluştur</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="couponCreate" role="form" action="<?=URI::get_path('coupon/createcoupon');?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <input type="number" id="ep" name="ep" class="form-control" id="form_control_1" required>
                            <label for="form_control_1">Ep Miktarı</label>
                            <span class="help-block">Oluştumak İstediğiniz Kuponun Ep Miktarını Giriniz...</span>
                        </div>
                        <div class="form-group form-md-line-input form-md-floating-label">
                            <select class="form-control edited" id="epCount" name="epCount">
                                <option value="1" selected>1 Adet</option>
                                <option value="5">5 Adet</option>
                                <option value="10">10 Adet</option>
                                <option value="15">15 Adet</option>
                                <option value="20">20 Adet</option>
                                <option value="50">50 Adet</option>
                                <option value="100">100 Adet</option>
                                <option value="200">200 Adet</option>
                                <option value="500">500 Adet</option>
                            </select>
                            <label for="form_control_1">Kaç Adet Kupon Oluşturmak İstiyorsunuz ?</label>
                        </div>
                    </div>
                    <div class="form-actions noborder">
                        <!--                        <button type="submit" class="btn blue">Kupon Oluştur</button>-->
                        <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                            <span class="ladda-label">Oluştur</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#couponCreate').submit(function (event) {
            event.preventDefault();
            var ept = $('#epCount').val();
            var data = $(this).serialize();
            var url = $(this).attr('action');
            var epCount = parseInt(ept);
            for(var i = 1; i <= epCount; i++ ){
                if(i == 1){
                    $('#ep').val('');
                    $('#epCount').val('1');
                    notify('success',ept + " Adet Kupon Oluşturuldu !");
                }
                $.post(url,data,function () {

                });
            }
        });
    });
</script>
<?php endif;?>