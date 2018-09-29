<?php
namespace sunlsoft\yiiweixin\request;

/**
 * @author sun
 * @desc   微信的消息加密处理类
 */
class wxEncodingCrypt {
	
	/**
	 * 检验消息的真实性，并且获取解密后的明文
	 * @param string $appid				公众号appid
	 * @param string $token				公众号令牌
	 * @param string $encodingAesKey	公众号加密密钥
	 * @param string $msgSignature		消息回复的验签
	 * @param string $timestamp			时间戳
	 * @param string $nonce				随机数
	 * @param string $encrypt			解密的密文
	 * @return array					['结果','信息']		如果正确 第一个访问为true  如果解密失败结果返回false 
	 */
	public function decryptMsg($appid,$token , $encodingAesKey = '',$msgSignature, $timestamp = null, $nonce, $encrypt){
		$encodingAesKey = base64_decode($encodingAesKey . "=");
		
		$signature = $this->getSHA1($token, $timestamp, $nonce, $encrypt);
		if ($signature != $msgSignature) {
			return [false,'验签不正确'];
		}
		//使用BASE64对需要解密的字符串进行解码
		$ciphertext_dec = base64_decode($encrypt);
		$module = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
		$iv = substr($encodingAesKey, 0, 16);
		mcrypt_generic_init($module, $encodingAesKey, $iv);
		//解密
		$decrypted = mdecrypt_generic($module, $ciphertext_dec);
		mcrypt_generic_deinit($module);
		mcrypt_module_close($module);
		
		//去除补位字符
		$result = $this->decode($decrypted);
		//去除16位随机字符串,网络字节序和AppId
		if (strlen($result) < 16){
			return [false,'解密后的appid长度不正确'];
		}
		$content = substr($result, 16, strlen($result));
		$len_list = unpack("N", substr($content, 0, 4));
		$xml_len = $len_list[1];
		$xml_content = substr($content, 4, $xml_len);
		$from_appid = substr($content, $xml_len + 4);
		
		if ($from_appid != $appid){
			return [false,'appid 不正确'];
		}
		return [true,$xml_content];
		
		
	}
	
	/**
	 * 对解密后的明文进行补位删除
	 * @param decrypted 解密后的明文
	 * @return 删除填充补位后的明文
	 */
	public function decode($text){
		
		$pad = ord(substr($text, -1));
		if ($pad < 1 || $pad > 32) {
			$pad = 0;
		}
		return substr($text, 0, (strlen($text) - $pad));
	}
	
	
	/**
	 * 用SHA1算法生成安全签名
	 * @param string $token 票据
	 * @param string $timestamp 时间戳
	 * @param string $nonce 随机字符串
	 * @param string $encrypt 密文消息
	 */
	public function getSHA1($token, $timestamp, $nonce, $encrypt_msg){
		$array = array($encrypt_msg, $token, $timestamp, $nonce);
		sort($array, SORT_STRING);
		$str = implode($array);
		return sha1($str);
	}
}

