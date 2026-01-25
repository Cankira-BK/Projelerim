<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"80") == true):?>
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
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-<?=$row['vnum']?>-modal-lg">Düzenle</button>
                                    </div>
                                </td>
                            </tr>
							
							
							<div class="modal fade bd-<?=$row['vnum'];?>-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">NPC Eşya Ekle</h4>
										</div>
										<div class="modal-body">
											<form id="newsEditForm" action="<?=URI::get_path('sql/npcitemekle')?>" role="form" autocomplete="off" method="post">
												<div class="form-body">
													<div class="form-group form-md-line-input">
														<select class="form-control edited" name="item_vnum">
															<?php foreach ($this->npcitemlist as $row2):?>
																	<option value="<?=$row2['vnum']?>"><?=Functions::utf8($row2['locale_name'])?></option>
															<?php endforeach;?>
														</select>
														<label class="control-label col-md-3">Eşya Seçiniz</label>
													</div>
													<div class="form-group form-md-line-input">
														<input type="number" class="form-control" name="item_count" value="1" required>
														<label class="control-label col-md-3">Adet</label>
													</div>
													<div class="form-group form-md-line-input">
														<label for="form_control_1">Fiyatı</label>
														<input type="text" name="price" class="form-control" id="item_price" value="">
													</div>
													<?php if ($row['npc_type'] == 5) {?>
													<div class="form-group form-md-line-input">
														<label for="form_control_1">Eşya Kodu</label>
														<input type="text" name="price_vnum" class="form-control" id="price_vnum" value="">
													</div>
													<?php }?>
													<input type="hidden" class="form-control" name="shop_vnum" value="<?=$row['vnum'];?>" required>
													<input type="hidden" class="form-control" name="shop_type" value="<?=$row['npc_type'];?>" required>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn dark btn-outline" data-dismiss="modal">Kapat</button>
											<button type="submit" form="newsEditForm" class="btn green">Güncelle</button>
										</div>
									</div>
									<!-- /.modal-content -->
								</div>
								<!-- /.modal-dialog -->
							</div>
							
						<?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
		</div>
	</div>
<?php endif;?>