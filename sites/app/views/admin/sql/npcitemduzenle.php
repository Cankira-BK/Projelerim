<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"90") == true):?>
	<div class="row">
		<div class="col-md-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red">
                        <i class="icon-list font-red"></i>
                        <span class="caption-subject bold uppercase">NPC İtem Ekle</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="findMeList">
                        <thead>
                        <tr>
                            <th>Npc Adı</th>
							<th>Npc Türü</th>
							<th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($this->npcliste as $row):?>
                            <tr>
                                <td><?=Functions::mobToNames($row['npc_vnum']);?></td>
								<td><?=Functions::npc_type($row['npc_type']);?></td>
                                <td>
                                    <div class="margin-bottom-5 text-center">
                                        <a href="<?=URI::get_path('sql/npcitemduzenle2/'.$row['vnum'])?>" class="btn btn-icon-only green text-center">
                                        <i class="fa fa-edit"></i>
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
<?php endif;?>