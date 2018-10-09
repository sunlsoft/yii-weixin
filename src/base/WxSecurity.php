<?php
namespace sunlsoft\yiiweixin\base;

use sunlsoft\yiiweixin\base\wxDataFormat;
use yii\base\Component;

/**
 * 微信的加密解密
 * @author sun
 *
 */
class WxSecurity extends Component{
	
	
	/**
	 * 检验消息的真实性，并且获取解密后的明文
	 * @param string $token				公众号令牌
	 * @param string $encodingAesKey	公众号加密密钥
	 * @param string $msgSignature		消息回复的验签
	 * @param string $timestamp			时间戳
	 * @param string $nonce				随机数
	 * @param string $encrypt			解密的密文
	 * @return array					['结果','信息']		如果正确 第一个访问为true  如果解密失败结果返回false
	 */
	public function decryptMsg($token , $encodingAesKey = '',$msgSignature, $timestamp = null, $nonce, $encrypt){
		
		$signature = $this->getSHA1($token, $timestamp, $nonce, $encrypt);
		
		if ($signature != $msgSignature){
			return [false,'签名不正确'];
		}
		
		// 		$ciphertext_dec = base64_decode($encrypt);
		$key= base64_decode($encodingAesKey . "=");
		$iv = substr($key, 0, 16);
		$xml=openssl_decrypt(base64_decode($encrypt), "aes-256-cbc", $key, OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING, $iv);
		
		
		$content = substr($xml, 16, strlen($xml));
		$len_list = unpack("N", substr($content, 0, 4));
		$xml_len = $len_list[1];
		$rxml = substr($content, 4, $xml_len);
		
		return [true,$rxml];
		
	}
	
	
	/**
	 *
	 * @param string $appid				公众号appid
	 * @param string $token				公众号token
	 * @param string $encodingAesKey	公众号加密密钥
	 * @param string $nonce				随机数
	 * @param string $text				加密的密文
	 * @return boolean[]|string[]		['结果','信息']		如果正确 第一个访问为true  如果解密失败结果返回false
	 */
	public function encryptMsg($appid,$token ,$encodingAesKey = '' ,$text){
		$key= base64_decode($encodingAesKey . "=");
		
		$timeStamp = time();
		$nonce = $this->getRandomStr();
		$text = $nonce . pack("N", strlen($text)) . $text . $appid;
		$iv = substr($encodingAesKey, 0, 16);
		$text = $this->encode($text);
		$encrypted = openssl_encrypt($text,'aes-256-cbc',$key,OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING,$iv);
		$encrypted = base64_encode($encrypted);
		$signature = $this->getSHA1($token, $timeStamp, $nonce, $encrypted);
		$arr = [
				'MsgSignature'=>$signature,
				'TimeStamp'=>$timeStamp,
				'Nonce'=>$nonce,
				'Encrypt'=>$encrypted,
		];
		
		return array(true, wxDataFormat::arraytoxml($arr));
		
	}
	
	/**
	 * 对需要加密的明文进行填充补位
	 * @param $text 需要进行填充补位操作的明文
	 * @return 补齐明文字符串
	 */
	public function encode($text)
	{
		$block_size = 32;
		
		$text_length = strlen($text);
		//计算需要填充的位数
		$amount_to_pad = $block_size - ($text_length % $block_size);
		if ($amount_to_pad == 0) {
			$amount_to_pad = block_size;
		}
		//获得补位所用的字符
		$pad_chr = chr($amount_to_pad);
		$tmp = "";
		for ($index = 0; $index < $amount_to_pad; $index++) {
			$tmp .= $pad_chr;
		}
		return $text . $tmp;
	}
	
	/**
	 * 随机生成16位字符串
	 * @return string 生成的字符串
	 */
	public function getRandomStr()
	{
		
		$str = "";
		$str_pol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
		$max = strlen($str_pol) - 1;
		for ($i = 0; $i < 16; $i++) {
			$str .= $str_pol[mt_rand(0, $max)];
		}
		return $str;
	}
	
	/**
	 * 对解密后的明文进行补位删除
	 * @param decrypted 解密后的明文
	 * @return 删除填充补位后的明文
	 */
	private function decode($text){
		
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
	private function getSHA1($token, $timestamp, $nonce, $encrypt_msg){
		$array = array($encrypt_msg, $token, $timestamp, $nonce);
		sort($array, SORT_STRING);
		$str = implode($array);
		return sha1($str);
	}
}

