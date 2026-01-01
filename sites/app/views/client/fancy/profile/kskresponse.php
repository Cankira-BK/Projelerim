<main class="content">
    <div class="panel panel-buyuk">
        <div class="panel-heading">
            <center>
				<?=$lng[153]?> </center>
        </div>
        <div class="panel-body">
            <div class="container_3 red wide fading-notification" align="center">
				<?php if($this->response['result'] == false): ?>
					<?php echo Client::alert('error',$lng[81]);?>
				<?php elseif ($this->response['result'] == true):?>
					<?php echo Client::alert('success',$lng[157]);?>
                    <h3 class="header-3" style="font: normal 25px 'Palatino Linotype', 'Times', serif; text-transform: none;"><?=$lng[158]?> : <?=$this->response['data'];?></h3>
				<?php endif;?>
            </div>
        </div>
    </div>
</main>