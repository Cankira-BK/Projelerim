<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-dark">
                    <i class="icon-settings font-dark"></i>
                    <span class="caption-subject bold uppercase">Arama Sonuçları (<?=$this->search['name']?>)</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Karakter Adı</th>
                        <th>Kullanıcı Adı</th>
                        <th>Durum</th>
                        <th>İp</th>
                        <th>İşlem</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($this->search['data'] as $row):?>
                        <tr>
                            <td><?=$row['id'];?></td>
                            <td><?=$row['name'];?></td>
                            <td><?=$row['login'];?></td>
                            <td><?=$row['job']?></td>
                            <td><?=$row['ip'];?></td>
                            <td>
                                <div class="margin-bottom-5 text-center">
                                    <a href="<?=URI::get_path('account/account/'.$row['account_id'])?>" class="btn btn-icon-only green text-center">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="<?=URI::get_path('account/ban/'.$row['account_id'])?>" class="btn btn-icon-only dark text-center">
                                        <i class="fa fa-lock"></i>
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