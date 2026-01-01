<?php
class Hasher
{
	/**
	 * @param $string = The value to be encrypted
	 * @param null $key = This your special {chip} key
	 * @return bool|string = Encrypted output
	 */
	public static function encrypt($string,$key=null)
	{
		return self::chip('encrypt',$string,$key);
	}

	/**
	 * @param $string = The value to be decrypted
	 * @param null $key = This your special {chip} key
	 * @return bool|string = Decrypted output
	 */
	public static function decrypt($string,$key=null)
	{
		return self::chip('decrypt',$string,$key);
	}

	/**
	 * @param $action = Action encrypt or decrypt
	 * @param $string = Value to be processed
	 * @param null $key = This your special {chip} key
	 * @return bool|string = Processed output
	 */
	private static function chip($action, $string ,$key=null)
	{
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = $key;
		$secret_iv = 'SwPsqMC76HD9rPHB';
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action === 'encrypt' )
		{
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action === 'decrypt' )
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		return $output;
	}
}