<?php
namespace sunlsoft\yiiweixin\response\wxResponseMessage;


use yii\base\Model;
use sunlsoft\yiiweixin\base\wxDataFormat;
use sunlsoft\yiiweixin\weixin;
use sunlsoft\yiiweixin\base\WxSecurity;

/**
 * @author sun
 * @desc   微信消息体基础类
 */
class wxResponseBaseObjct extends Model{
	
	/**
	 * 开发者微信号
	 * @var string
	 */
	public $ToUserName = '';
	
	/**
	 * 发送方帐号（一个OpenID）
	 * @var string
	 */
	public $FromUserName = '';
	
	/**
	 * 公众号的appid
	 * @var string
	 */
	public $appid = '';
	
	/**
	 * 微信后台令牌
	 * @var string
	 */
	public $Token = '';
	
	/**
	 * 微信消息加解密密
	 * @var string
	 */
	public $EncodingAESKey = '';
	
	/**
	 * 加密模式
	 * @var unknown
	 */
	public $EncodingType = weixin::ENCODING_TXT;
	
	
	/**
	 * 消息的类型
	 * @var string
	 */
	public $MsgType = '';
	
	public function getBaseArr(){
		$arr = [
				'ToUserName'=>$this->ToUserName,
				'FromUserName'=>$this->FromUserName,
				'CreateTime'=>time(),
		];
		return $arr;
	}
	
	public function getArr(){
		
	}
	
	public function getResponseXML(){
		$butes = $this->getArr();
		
		return wxDataFormat::arraytoxml($butes);	
	}
	
	public function getResponse(){
		$xml = $this->getResponseXML();
		
		$WxSecurity = new WxSecurity();
		list($resBool,$txt) = $WxSecurity->encryptMsg($this->appid, $this->Token,$this->EncodingAESKey, $xml);
		if (!$resBool){
			return false;
		}
		
		return $txt;
	}
	
}

