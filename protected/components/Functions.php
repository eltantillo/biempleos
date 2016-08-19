<?php
class Functions{
	public static function cifrar($string){
		$cipher = "rijndael-128"; 
		$mode = "cbc"; 
		$secret_key = "CLAVEPRUEBALIMIT";
		//iv length should be 16 bytes 
		$iv = "fedcba9876543210"; 

		// Make sure the key length should be 16 bytes 
		$key_len = strlen($secret_key); 
		if($key_len < 16 ){ 
		    $addS = 16 - $key_len; 
		    for($i =0 ;$i < $addS; $i++){ 
		        $secret_key.=" "; 
		    } 
		}
		else{ 
		    $secret_key = substr($secret_key, 0, 16); 
		}

		$td = mcrypt_module_open($cipher, "", $mode, $iv); 
		mcrypt_generic_init($td, $secret_key, $iv); 
		$cyper_text = mcrypt_generic($td, $string); 
		mcrypt_generic_deinit($td); 
		mcrypt_module_close($td); 
		return bin2hex($cyper_text);
	}

	public static function decifrar($string){

		$cipher = "rijndael-128"; 
		$mode = "cbc"; 
		$secret_key = "CLAVEPRUEBALIMIT"; 
		//iv length should be 16 bytes 
		$iv = "fedcba9876543210"; 

		// Make sure the key length should be 16 bytes 
		$key_len = strlen($secret_key); 
		if($key_len < 16 ){ 
		    $addS = 16 - $key_len; 
		    for($i =0 ;$i < $addS; $i++){ 
		        $secret_key.=" "; 
		    } 
		}
		else{ 
		    $secret_key = substr($secret_key, 0, 16); 
		}

		$td = mcrypt_module_open($cipher, "", $mode, $iv); 
		mcrypt_generic_init($td, $secret_key, $iv); 
		$decrypted_text = mdecrypt_generic($td, hex2bin($string)); 
		mcrypt_generic_deinit($td); 
		mcrypt_module_close($td); 
		return trim($decrypted_text);
	}
}
?>