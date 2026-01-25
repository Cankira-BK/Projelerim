<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 4.01.2017
     * Time: 00:37
     */
    class Form{

        /**
         * @param $data array
         * @return string <form $data>
         */
        public function open($data){
            $value = '<form ';
            foreach ($data as $key=>$row){
                $value .= $key . '="'. $row.'" ';
            }
            $value = rtrim($value,' ');
            $value .= '>'.PHP_EOL;
            return $value;
        }

        /**
         * @param $type string
         * @param $data array
         * @return string <input type="$type" $data>
         */
        public function input($type,$data){
            $value = "<input type='$type' ";
            foreach ($data as  $key=>$row){
                $value .= $key . '="' . $row . '" ';
            }
            $value = rtrim($value,' ');
            $value .= ">";
            return $value;
        }

        /**
         * @param $data array
         * @param $option array
         * @param null $selected
         * @return string select->option->/select
         */
        public function select($data,$option,$selected=null){
                $value = "<select ";
                foreach ($data as  $key=>$row){
                    $value .= $key . '="' . $row . '" ';
                }
                $value = rtrim($value,' ');
                $value .= ">".PHP_EOL;
                //Option
                    foreach ($option as  $k=>$v){
                        if($k == $selected)
                            $value .= '<option value="'.$k.'" selected>'.$v.'</option>'.PHP_EOL;
                        else
                            $value .= '<option value="'.$k.'">'.$v.'</option>'.PHP_EOL;
                    }
                $value .= "</select>".PHP_EOL;
            return $value;
        }

        /**
         * @param $data array
         * @param null $content
         * @return string <textarea $data>$content</textarea>
         */
        public function textarea($data,$content=null){
            $value = "<textarea ";
            foreach ($data as  $key=>$row){
                $value .= $key . '="' . $row . '" ';
            }
            $value = rtrim($value,' ');
            $value .= ">".PHP_EOL;
            $value .= $content.PHP_EOL."</textarea>".PHP_EOL;
            return $value;
        }

        /**
         * @param $data = array();
         * @return string <button type="button">$data['value']</button>
         */
        public function button($data){
            $value = "<button type='button' ";
            foreach ($data as  $key=>$row){
                if($key != "value")
                $value .= $key . '="' . $row . '" ';
            }
            $value = rtrim($value,' ');
            $value .= ">";
            $value .= $data['value'];
            $value .= "</button>";
            return $value;
        }

        /**
         * @return string  = </form>
         */
        public function close(){
            $value = '</form>';
            return $value;
        }
    }
