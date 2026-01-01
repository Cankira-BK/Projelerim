<?php if (Functions::checkAllPermission($_SESSION['allPermissionArray'],"90") == true):?>
	<div class="row">
		<div class="col-md-9">
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red">
                        <i class="icon-list font-red"></i>
                        <span class="caption-subject bold uppercase">NPC Ekle</span>
                    </div>
                    <div class="tools"> </div>
                </div>
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover order-column" id="findMeList">
                        <thead>
                        <tr>
                            <th>Npc Kodu</th>
                            <th>Npc Adı</th>
							<th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($this->npcliste as $row):?>
                            <tr>
                                <td><?=$row['vnum'];?></td>
                                <td><?=Functions::utf8($row['locale_name']);?></td>
                                <td>
                                    <div class="margin-bottom-5 text-center">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-<?=$row['vnum']?>-modal-lg">Seç</button>
                                    </div>
                                </td>
                            </tr>
							
							
							<div class="modal fade bd-<?=$row['vnum'];?>-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
											<h4 class="modal-title">NPC Ekle (<?=$row['vnum'];?> | <?=Functions::utf8($row['locale_name']);?>)</h4>
										</div>
										<div class="modal-body">
											<form id="newsEditForm" action="<?=URI::get_path('sql/npcekle')?>" role="form" autocomplete="off" method="post">
												<div class="form-body">
													<div class="form-group form-md-line-input">
														<select class="form-control edited" name="shop_type">
															<option value="0">Yang Market</option>
															<option value="1">EP Market</option>
															<option value="2">EM Market</option>
															<option value="3">Derece Market</option>
															<option value="4">Won Market</option>
															<option value="5">Eşya Market</option>
															<option value="6">Metin Gaya Market</option>
															<option value="7">Boss Gaya Market</option>
														</select>
														<label class="control-label col-md-3">Yeni NPC Türü</label>
													</div>
													<input type="hidden" class="form-control" name="npc_vnum" value="<?=$row['vnum'];?>" required>
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn dark btn-outline" data-dismiss="modal">Kapat</button>
											<button type="submit" form="newsEditForm" class="btn green">Kaydet</button>
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