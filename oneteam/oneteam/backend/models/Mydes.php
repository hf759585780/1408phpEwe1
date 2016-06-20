<?php
namespace app\models;
use yii;
/**
 +------------------------------------------------------------------------------
 * DES 加密解密类 依赖mcrypt扩展
 * @author    李明 <liming@com133.com>
 +------------------------------------------------------------------------------
 */
 class Mydes
 {
		//DES 加密
		public function  des($encrypt, $key = '12345678') {
			
			$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_DES, MCRYPT_MODE_ECB ), MCRYPT_RAND );
			$passcrypt = mcrypt_encrypt ( MCRYPT_DES, $key, $encrypt, MCRYPT_MODE_ECB, $iv );
			return $passcrypt;
		}
		/**
		 * 将二进制数据转换成十六进制
		 */
		public function asc2hex($temp) {
			return bin2hex ( $temp );
		}

		/**
		 * 十六进制转换成二进制
		 *
		 * @param string
		 * @return string
		 */
		public function hex2asc($temp) {
			$len = strlen ( $temp );
			$data = '';
			for($i = 0; $i < $len; $i += 2)
				$data .= chr ( hexdec ( substr ( $temp, $i, 2 ) ) );
			return $data;
		}
		//DES解密
		public function un_des($decrypt, $key = '12345678') {
			
			$iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_DES, MCRYPT_MODE_ECB ), MCRYPT_RAND );
			$decrypted = mcrypt_decrypt ( MCRYPT_DES, $key, $decrypt, MCRYPT_MODE_ECB, $iv );
			return $decrypted;
		}

 }


?>