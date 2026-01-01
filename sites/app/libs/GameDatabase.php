<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 23.01.2017
     * Time: 18:45
     */
    namespace GameDatabase;
    class GameDatabase extends \PDO
    {
		private $_select;
		private $_table;
		private $_bindValue;
		private $_bindKey;
		private $_where;
		private $_queryString;

		public function __construct($DB_HOST, $DB_USER, $DB_PASS)
		{
			try {
				parent::__construct('mysql:host='.$DB_HOST.';dbname='.ACCOUNT_DB_NAME.'', $DB_USER, $DB_PASS, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
			}catch (\Exception $error) {
				exit(self::errorTheme($error->getCode()));
			}
		}
		private static function errorTheme($errorCode)
		{

			$theme = "
		<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'/>
        <div id='container' style='margin: 10px;border: 1px solid #D0D0D0;box-shadow: 0 0 8px #D0D0D0;'>
        <h1 style='color: #444;background-color: transparent;border-bottom: 1px solid #D0D0D0;font-size: 19px;font-weight: normal;margin: 0 0 14px 0;padding: 14px 15px 10px 15px;'>Database Bağlantı Hatası</h1>
        <p style='margin: 12px 15px 12px 15px;'>Hata Kodu: ".$errorCode."</p>
        <p style='margin: 12px 15px 12px 15px;'>Açıklama: ".self::errorMessage($errorCode)."</p>
        <p style='margin: 12px 15px 12px 15px;'>Tür: İkincil</p>
        </div>";
			return $theme;
		}
		private static function errorMessage($errorCode)
		{
			if ($errorCode === 2002)
				return "Bilinen böyle bir ana bilgisayar yok";
			elseif ($errorCode === 1049)
				return "Hatalı database adı";
			elseif ($errorCode === 1044)
				return "Hatalı kullanıcı adı";
			elseif ($errorCode === 1045)
				return "Hatalı şifre";
		}

		/**
		 * @param string $arg
		 * @return $this
		 * SELECT $arg FROM
		 */
		public function select($arg = "*")
		{
			$this->_select = "SELECT $arg FROM ";
			return $this;
		}

		public function table($arg)
		{
			$this->_table = "$arg ";
			return $this;
		}

		public function where($array = array(),$what = 'and')
		{
			$bindValue = null;
			$bindKey = null;
			$where = null;
			$count = count($array);
			$i = 0;
			foreach ($array as $key=>$row)
			{
				$i++;
				if($i == $count){
					$where .= $key.'=:'.$key;
				}else{
					$where .= $key.'=:'.$key." $what ";
				}
				$bindValue .= $row.',';
				$bindKey .=':'.$key.',';
			}
			$this->_bindValue = rtrim($bindValue,',');
			$this->_bindKey = rtrim($bindKey,',');
			$this->_where = "WHERE " . $where;
			return $this;
		}

		public function get()
		{
			$bindKey = explode(',',$this->_bindKey);
			$bindValue = explode(',',$this->_bindValue);
			$bindCount = count($bindKey);
			$this->_queryString = $this->_select.$this->_table.$this->_where;
			$sth = $this->prepare($this->_queryString);
			$this->_setLog("select");
			for ($i = 0; $i < $bindCount; $i++)
			{
				$sth->bindValue($bindKey[$i],$bindValue[$i], \PDO::PARAM_STR);
			}
			$sth->execute();
			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}

		public function count()
		{
			$bindKey = explode(',',$this->_bindKey);
			$bindValue = explode(',',$this->_bindValue);
			$bindCount = count($bindKey);
			$this->_queryString = $this->_select.$this->_table.$this->_where;
			$sth = $this->prepare($this->_queryString);
			$this->_setLog("select");
			for ($i = 0; $i < $bindCount; $i++)
			{
				$sth->bindValue($bindKey[$i],$bindValue[$i], \PDO::PARAM_STR);
			}
			$sth->execute();
			return $sth->rowCount();
		}

		public function sql($sql, $data = null)
		{
			$data = ($data !== null) ? $data : array();
			$this->_queryString = $sql;
			if ($this->_firstCharacter($this->_queryString) === "select") {
				$sth = $this->prepare($this->_queryString);
				if (!empty($data)) {
					$bindCount = count($data);
					for ($i = 0; $i < $bindCount; $i++) {
						$sth->bindValue($i + 1, $data[$i]);
						$this->_bindValue .= $data[$i] . ',';
					}
				}
				$this->_bindValue = rtrim($this->_bindValue, ',');
				$sth->execute();
				$return = $sth->fetchAll(\PDO::FETCH_ASSOC);
			} else {
				$sth = $this->prepare($this->_queryString);
				if (!empty($data)) {
					$bindCount = count($data);
					for ($i = 0; $i < $bindCount; $i++) {
						$sth->bindValue($i + 1, $data[$i]);
						$this->_bindValue .= $data[$i] . ',';
					}
				}
				$this->_bindValue = rtrim($this->_bindValue, ',');
				$sth->execute();
				$return = ($sth->rowCount()) ? true : false;
			}
			$this->_setLog('other');
			return $return;
		}

		public function __call($name, $arguments)
		{
			$bindKey = explode(',',$this->_bindKey);
			$bindValue = explode(',',$this->_bindValue);
			$bindCount = count($bindKey);
			$sth = $this->prepare($this->_select.$this->_table.$this->_where);
			for ($i = 0; $i < $bindCount; $i++){
				$sth->bindValue($bindKey[$i],$bindValue[$i], \PDO::PARAM_STR);
			}
			$sth->execute();
			$fetch = $sth->fetch(\PDO::FETCH_ASSOC);
			$Name = $name;
			$name = $fetch[$name];
			if(in_array($name, $fetch)){
				$arguments = $fetch;
				return $arguments[$Name];
			}
		}

		/**
		 * insert
		 * @param string $table table name
		 * @param array $data [array]
		 */
		public function insert($table, $data = array())
		{
			ksort($data);

			$fieldNames = implode('`, `', array_keys($data));
			$fieldValues = ':' . implode(', :', array_keys($data));

			$this->_queryString = "INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)";
			$sth = $this->prepare($this->_queryString);

			$bindValues = null;
			foreach ($data as $key => $value)
			{
				$sth->bindValue(":$key", $value,\PDO::PARAM_STR);
				$bindValues .= $value;
			}
			$this->_bindValue = rtrim($bindValues,',');
			$this->_setLog('insert');
			$sth->execute();
		}

		/**
		 * update
		 * @param string $table table name
		 * @param array $data [array]
		 * @param array $where [array]
		 */
		public function update($table, $data = array(), $where = array())
		{
			ksort($data);
			ksort($where);
			$countWhere = count($where);
			$fieldDetails = NULL;
			foreach($data as $key=> $value) {
				$fieldDetails .= "`$key`=:$key,";
			}
			$fieldDetails = rtrim($fieldDetails, ',');


			$fieldWhere = NULL;
			$i = 0;
			foreach ($where as $key => $value){
				$i++;
				if($i == $countWhere){
					$fieldWhere .= "`$key`=:$key";
				}else{
					$fieldWhere .= "`$key`=:$key and ";
				}
			}
			$fieldWhere = rtrim($fieldWhere, ',');
			$this->_queryString = "UPDATE $table SET $fieldDetails WHERE $fieldWhere";
			$sth = $this->prepare($this->_queryString);

			$bindValues = null;
			foreach ($data as $key => $value)
			{
				$sth->bindValue(":$key", $value,\PDO::PARAM_STR);
				$bindValues .= $value.',';
			}
			foreach ($where as $key=>$value)
			{
				$sth->bindValue(":$key",$value,\PDO::PARAM_STR);
				$bindValues .= $value.',';
			}
			$this->_bindValue = rtrim($bindValues,',');
			$this->_setLog('update');
			$sth->execute();
		}

		/**
		 * delete
		 *
		 * @param string $table table name
		 * @param array $where [array]
		 * @param integer $limit default 1;
		 * @return integer Affected Rows
		 */
		public function delete($table, $where = array(), $limit = 1)
		{
			ksort($where);
			$countWhere = count($where);
			$fieldWhere = NULL;
			$i = 0;
			foreach ($where as $key => $value){
				$i++;
				if($i == $countWhere){
					$fieldWhere .= "`$key`=:$key";
				}else{
					$fieldWhere .= "`$key`=:$key and ";
				}
			}
			$fieldWhere = rtrim($fieldWhere, ',');
			$this->_queryString = "DELETE FROM $table WHERE $fieldWhere LIMIT $limit";
			$sth = $this->prepare($this->_queryString);

			$bindValues = null;
			foreach ($where as $key=>$value)
			{
				$sth->bindValue(":$key",$value,\PDO::PARAM_STR);
				$bindValues .= $value.',';
			}
			$this->_bindValue = rtrim($bindValues,',');
			$this->_setLog('delete');
			$sth->execute();
		}
		private function _setLog($fileName)
		{
			$debug = debug_backtrace()[1];
			$content = ["Tarih"=>date('Y-m-d H:i:s'),"Sorgu"=>$debug['object']->_queryString,"Veriler"=>$debug['object']->_bindValue,"Dosya"=>$debug['file'],"Satır"=>$debug['line']];
			$jsonFormat = json_encode($content).";\n";
			$logFile = fopen(dirname(dirname(dirname(__FILE__))).'/data/log/gdb-'.$fileName.'.txt',"a") or die("file not exist");
			fwrite($logFile,$jsonFormat);
			fclose($logFile);
		}

		/**
		 * @param $string
		 * @return string
		 */
		private function _firstCharacter($string)
		{
			if (substr($string, 0, 1) === "S" || substr($string, 0, 1) === "s")
				$return = "select";
			elseif (substr($string, 0, 1) === "I" || substr($string, 0, 1) === "i")
				$return = "insert";
			elseif (substr($string, 0, 1) === "U" || substr($string, 0, 1) === "u")
				$return = "update";
			elseif (substr($string, 0, 1) === "D" || substr($string, 0, 1) === "d")
				$return = "delete";
			return $return;
		}
	}