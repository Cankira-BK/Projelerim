<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"80") == true):?>
	<div class="row">
		<div class="col-md-9">

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-key font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase">"Genel Özellik Yönetimi" Ekle </span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form id="captchaedit" role="form" action="<?=URI::get_path('site/landing1');?>" method="post">
                        <div class="form-body">
                            <div class="form-group form-md-line-input form-md-floating-label">
                                <input type="text" name="findme" class="form-control" id="form_control_1">
                                <label for="form_control_1">"Genel Özellik" Ekle </label>
                                <span class="help-block">Lütfen "Genel Özellik" değeri giriniz...</span>
                            </div>
                        </div>
                        <div class="form-actions noborder">
                            <button type="submit" class="btn green mt-ladda-btn ladda-button" data-style="contract">
                                <span class="ladda-label">Ekle</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red">
                        <i class="icon-list font-red"></i>
                        <span class="caption-subject bold uppercase">"Genel Özellikler" Listesi</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="findMeList">
                        <thead>
                        <tr>
                            <th>Özellik Adı</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($this->all as $row):?>
                            <tr>
                                <td><?=$row['kategori_adi'];?></td>
                                <td>
                                    <div class="margin-bottom-5 text-center">
                                        <a href="<?=URI::get_path('site/landingdelete1/'.$row['kategori_id'])?>" class="btn btn-icon-only dark text-center">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
						<?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
	<script>
        $('#findmeEdit').submit(function (eve) {
            eve.preventDefault();
            var url = $(this).attr('action');
            var data = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (!response.result)
                        notify('error',response.message);
                    else
                        notify('success',response.message);
                }
            });
        });
	</script>
<?php endif;?>