<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 28.12.2016
     * Time: 02:36
     */
    use Model\IN_Model;

    class IndexModel extends IN_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function index()
        {
        	if (Cache::check('patch_android'))
				$result['patch'] = $this->db->sql("SELECT id,title,image,tarih,content2 FROM patch ORDER BY tarih DESC LIMIT 0,4");
			$result['events'] = $this->db->sql("SELECT day,name,time FROM events ORDER BY owner ASC");
			return isset($result) ? $result : null;
        }
        public function patch(){
            $data = filter_var($_POST['data'],FILTER_SANITIZE_STRING);
            $result['data'] = $this->db->sql("SELECT * FROM patch LIMIT $data,3");
            $content['count'] = $data + 3;
            $content['data'] = "";
            foreach ($result['data'] as $row){
                $messageC = strlen($row['content2']);
                if ($messageC > 50 ){
                    $message = substr($row['content2'],0,150) . '...';
                }else{
                    $message = $row['content2'];
                }
                $content['data'] .= '<div class="article-wrapper">
                    <a href="'.URI::get_path('patch/view/').$row['id'].'"
                       itemprop="url">
                        <div class="article-image"
                             style="background-image:url('.$row['image'].')">
                            <div class="article-image-frame"></div>
                        </div>
                        <div class="article-content" itemprop="blogPost" itemscope="itemscope" itemtype="http://schema.org/BlogPosting">
                            <h2 class="header-2"><span class="article-title" itemprop="headline">'.
                    $row['title']
                    .'</span>
                            </h2>
                            <span class="clear"><!-- --></span>
                            <div class="article-summary" itemprop="description">'.$message. '</div>
                            <span class="clear"><!-- --></span>
                        </div>
                    </a>
                    <div class="article-meta">
		<span class="publish-date" title="'.$row['tarih'].'">'.
                    $this->zaman($row['tarih']).'
		</span>
                        <a href="'.URI::get_path('patch/view/').$row['id'].'"
                           class="comments-link">Daha Fazla Oku</a>
                    </div>
                    <span class="clear"><!-- --></span>
                </div>';
            }
            echo json_encode($content);
        }
        public function patch2(){
            $data = filter_var($_POST['data'],FILTER_SANITIZE_STRING);
            $result['data'] = $this->db->sql("SELECT * FROM patch LIMIT $data,3");
            $content['count'] = $data + 3;
            $content['data'] = "";
            foreach ($result['data'] as $row){
                $messageC = strlen($row['content2']);
                if ($messageC > 50 ){
                     $message = substr($row['content2'],0,150) . '...';
                }else{
                     $message = $row['content2'];
                }
                $content['data'] .= '<div class="main-text">
                        <div class="bg-light">
                            <div class="fr-view">
                                <p style="text-align: center;"><img src="'.$row['image'].'" style="width: 250px;" class="fr-fic fr-dib"></p><p style="text-align: center;">
                                    <span style="font-size: 20px; font-family: Tahoma, Geneva, sans-serif;">
                                        '.$row['title'].'
                                        <br>
                                        <font style="font-family: \'Raleway\', sans-serif;font-size: 12px;">'.$row['content2'].'</font>
                                        <br><br>
                                        <a class="btn-news btn" href="'.URI::get_path('patch/view/'.$row['id']).'">Daha fazla oku</a>
                                         </span>
                                </p>
                            </div>
                            <div class="news-sig">Yayın Tarihi : '.$this->zaman($row['tarih']).'</div>
                        </div>
                    </div>';
            }
            echo json_encode($content);
        }
        public function zaman($zaman){
            $onceBol = explode(" ", $zaman);
            $gay = explode("-", $onceBol[0]);
            $sds = explode(":", $onceBol[1]);
            $zaman = mktime($sds[0],$sds[1],$sds[2],$gay[1],$gay[2],$gay[0]);
            $zaman_farki = time() - $zaman;
            $saniye = $zaman_farki;
            $dakika = round($zaman_farki/60);
            $saat = round($zaman_farki/3600);
            $gun = round($zaman_farki/86400);
            $hafta = round($zaman_farki/604800);
            $ay = round($zaman_farki/2419200);
            $yil = round($zaman_farki/29030400);
            if($saniye < 60){
                if ($saniye == 0){
                    return "Az Önce";
                }else {
                    return 'Yaklaşık '.$saniye .' saniye önce';
                }
            }else if($dakika < 60){
                return 'Yaklaşık '.$dakika .' dakika önce';
            }else if($saat < 24){
                return 'Yaklaşık '.$saat.' saat önce';
            }else if($gun < 7){
                return 'Yaklaşık '.$gun .' gün önce';
            }else if($hafta < 4){
                return 'Yaklaşık '.$hafta.' hafta önce';
            }else if($ay < 12){
                return 'Yaklaşık '.$ay .' ay önce';
            }else{
                return 'Yaklaşık '.$yil.' yıl önce';
            }
        }
    }
