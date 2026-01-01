<div class="row">
    <div class="col-md-6 ">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-green">
                    <i class="fa fa-barcode font-green"></i>
                    <span class="caption-subject bold uppercase"> İndirim Uygula</span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="categoryCreate" role="form" action="<?=URI::get_path('product/discountok/'.$this->itemId);?>" method="post">
                    <div class="form-body">
                        <div class="form-group form-md-line-input has-info">
                            <div class="input-group">
                                <span class="input-group-addon">%</span>
                                <input type="number" name="discount" class="form-control" required>
                                <span class="help-block">Değer Yüzde Olarak Hesaplanacaktır...</span>
                                <label for="form_control_1">Ne Kadar İndirim Uygulamak İstiyorsunuz ? </label>
                            </div>
                        </div>
                        <span class="help-block">Örn. 20 değerini girdiğinizde 100 EP olan eşyanın yeni fiyatı 80 EP olur.</span>
                    </div>
                    <div class="form-actions noborder">
                        <button type="submit" class="btn blue">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>