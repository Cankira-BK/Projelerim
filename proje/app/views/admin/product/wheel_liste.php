<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"6") == true):?>
	<?php
	/**
	 * Created by PhpStorm.
	 * User: User
	 * Date: 17.11.2016
	 * Time: 08:28
	 */
	if(Session::get('changeOK') == true){
		echo '<script>$(document).ready(function() {
  notify("success","İşlem başarılı");
});</script>';
		Session::set('changeOK',false);
	}
	?>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-dark">
                        <i class="glyphicon glyphicon-shopping-cart font-dark"></i>
                        <span class="caption-subject bold uppercase">Market Eşya Listesi</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <a href="<?=URI::get_path('product/wheel_deleteall')?>" class="btn btn-danger">Tüm Eşyaları Sil</a>
                    <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th>İd</th>
                            <th>İsim</th>
                            <th>İşlemi <i id="what"></i> </th>
                        </tr>
                        </thead>
                        <tbody>

						<?php foreach ($this->items as $row):?>
                        <tr>
                            <td><?= $row['vnum']?></td>
                            <td><?= $row['item_name']?></td>
                            <td>
                            <div class="margin-bottom-5 text-center">
                                <a href="<?=URI::get_path('product/wheel_itemdelete/'.$row['id'])?>" id="itemRemove" class="btn btn-icon-only dark text-center">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                            </td>
                            </tr>
						<?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>