<div class="main-panel panel-download">
    <div class="main-header">
        Güvenli PC Pasif Etme
    </div>
    <div class="main-content">
        <div class="main-inner">
            <div class="content-title"></div>
            <div class="main-text-bg">
                <div class="main-text">
                    <div class="bg-light">
                        <?php if($this->response['result'] == false): ?>
                            <?php echo Client::alert('error','Sistem : Bu alana giriş yetkiniz yok.');?>
                        <?php elseif ($this->response['result'] == true):?>
                            <?php echo Client::alert('success','Güvenli PC Pasif Edilmiştir.');?>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-bottom"></div>
</div>