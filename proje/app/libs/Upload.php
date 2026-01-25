<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 30.12.2016
     * Time: 04:19
     */
    class Upload
    {

        public function multiple_arr($arr)
        {
            $files = array();
            foreach ($arr as $k => $l) {
                foreach ($l as $i => $v) {
                    if (!array_key_exists($i, $files))
                        $files[$i] = array();
                    $files[$i][$k] = $v;
                }
            }
            return $files;
        }
        //
        // 1.result  =  data["result"]
        // 2.result  =  data["message"]
        //
		public function image_upload($file)
		{
			$tmp_name = $file["tmp_name"];
			$name = $file["name"];
			$type = $file["type"];
			$extension = pathinfo($name, PATHINFO_EXTENSION);
			$allowedExtension = array("gif", "jpeg", "jpg", "png");
			if (in_array($extension,$allowedExtension))
			{
				if ($type == "image/jpeg" || $type == "image/png" || $type == "image/gif" || $type == "image/jpg")
				{
					$newName = $this->generateRandomString().'.'.$extension;
					$uploadPath = "data/upload/".$newName;
					if(move_uploaded_file($tmp_name,$uploadPath))
						$return = ["result" => true,"name"=>$newName,"paths"=>$uploadPath];
					else
						$return = ["result"=>false];

				}else
					$return = ["result"=>false];
			}
			else
				$return = ["result"=>false];
			return $return;
		}
        public function uploadsx($files,$path="upload")
        {
            $images = $files;
            $imageSize=1024*1024;
            $files = $this->multiple_arr($images);
            $data[][] = null;
            foreach ($files as $key=>$file) {
                $tmp_name = $file["tmp_name"];
                $name = $file["name"];
                $size = $file["size"];
                $type = $file["type"];
                $isImage = getimagesize($tmp_name);
				$extension = pathinfo($name, PATHINFO_EXTENSION);
				echo $extension;
				$allowedExtension = array("gif", "jpeg", "jpg", "png", "blob");
				if (in_array($extension, $allowedExtension)) {
					if($isImage[0] < 1024 and $isImage[0] != 2570) {
						if($size < $imageSize){
							if($type == "image/jpeg" or $type == "image/png" or $type == "image/gif"){
								$extension = substr($name,-4,4);
								$paths = 'data/'.$path.'/';
								$newName = $this->generateRandomString().$extension;
								$uploadPath = $paths.$newName;
								error_reporting(0);
								$open = opendir('data/'.$path);
								if($open == false){
									mkdir('data/'.$path,'0655');
								}
								if(move_uploaded_file($tmp_name,$uploadPath)){
									$data[$key]["result"] .= "true";
									$data[$key]["message"] .= "Yükleme İşlemi Başarılı";
									$data[$key]["name"] .= $newName;
									$data[$key]["paths"] .= $uploadPath;
								}else{
									$data[$key]["result"] .= "false";
									$data[$key]["message"] .= "Yükleme İşlemi Başarısız";
								}
							}else{
								$data[$key]["result"] .= "false";
								$data[$key]["message"] .= "Desteklenen Uzantılar (jpg,png,gif)";
							}
						}else{
							$data[$key]["result"] .= "false";
							$data[$key]["message"] .= "Maksimum Resim Boyutu $imageSize olmalıdır";
						}
					}else{
						$data[$key]["result"] .= "false";
						$data[$key]["message"] .= "Maksimum Resim Boyutu 1024 * 1024 olmalıdır";
					}
				}else{
					$data[$key]["result"] .= "false";
					$data[$key]["message"] .= "Desteklenen Uzantılar (jpg,png,gif)";
				}
            }
            return $data;
        }

        public function generateRandomString($length = 15) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }