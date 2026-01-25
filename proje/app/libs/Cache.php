<?php
class Cache
{
	public static function open($fileName)
	{
		if (!file_exists('data/cache'))
			mkdir('data/cache',0777,true);
		$cacheFolder = self::md5Key($fileName).'.cch';
		$cachePath = 'data/cache/'.$cacheFolder;
		$fileTime = (file_exists($cachePath)) ? filemtime($cachePath) : 0;
		if (time() - CACHETIME < $fileTime)
			echo self::fileRead($cachePath);
		else
		{
			if (file_exists($cachePath))
				unlink($cachePath);
			ob_start();
		}
	}
	public static function close($fileName)
	{
		$cacheFolder = self::md5Key($fileName).'.cch';
		$cachePath = 'data/cache/'.$cacheFolder;
		$fileTime = (file_exists($cachePath)) ? filemtime($cachePath) : 0;
		if (time() - CACHETIME >= $fileTime)
		{
			self::fileWrite($cachePath,ob_get_contents(),"w+");
			ob_end_flush();
		}
	}
	public static function check($fileName)
	{
		$cacheFolder = self::md5Key($fileName).'.cch';
		$cachePath = 'data/cache/'. $cacheFolder;
		$fileTime = (file_exists($cachePath)) ? filemtime($cachePath) : 0;
		if (time() - CACHETIME >= $fileTime)
			return true;
		else
			return false;
	}
	private static function md5Key($data)
	{
		$context = hash_init("md5", HASH_HMAC, \StaticDatabase\StaticDatabase::settings('tokenkey'));
		hash_update($context, $data);
		return hash_final($context);
	}
	private static function fileRead($file,$permission = "r")
	{
		$filePath = dirname(dirname(dirname(__FILE__))) . '/' . $file;
		$fOpen = fopen($filePath, $permission) or die("$file not found");
		$content = fread($fOpen,filesize($filePath));
		fclose($fOpen);
		return $content;
	}
	private static function fileWrite($file,$content,$permission = "a+")
	{
		$filePath = dirname(dirname(dirname(__FILE__))) . '/' . $file;
		$fOpen = fopen($filePath,$permission);
		if (fwrite($fOpen,$content))
			$return = true;
		else
			$return = false;
		fclose($fOpen);
		return $return;
	}
	private static function fileCreate($file,$content)
	{
		@unlink("data/cache/$file");
		$dosyaislem = fopen("data/cache/$file","a");
		fwrite($dosyaislem,$content);
		fclose($dosyaislem);
	}
	public static function delete($fileName)
	{
		if ($fileName === 'all')
		{
			$mainDir = array_diff(scandir('data/cache'), array('.', '..'));
			foreach ($mainDir as $row)
			{
				if (file_exists('data/cache/'.$row))
					unlink('data/cache/'.$row);
			}
		}
		else
		{
			$cacheFolder = self::md5Key($fileName).'.cch';
			if (file_exists('data/cache/'.$cacheFolder))
				unlink('data/cache/'.$cacheFolder);
		}
		
		self::fileCreate("index.html","<html><head><title>403 Forbidden</title></head><body><h1>Forbidden</h1><p>You don't have permission to accesson this server.</p></body></html>");
	}
}