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
	 * 消息创建时间 （整型）
	 * @var integer
	 */
	public $CreateTime = 0;
	
	
	public function rules(){
		return [
				[['ToUserName', 'FromUserName'], 'required'],
		];
	}
	
	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
				'ToUserName' => '接收方帐号（收到的OpenID）',
				'FromUserName'=>'开发者微信号',
				'CreateTime'=>'消息创建时间 （整型）'
		];
	}
	
	
	/**
	 * 消息的类型
	 * @var string
	 */
	public $MsgType = '';
	
	
	public function getArr(){
		if (!$this->validate()){
			return false;
		}
		$this->CreateTime = time();
		$attributeLabels = $this->attributeLabels();
		return $this->getAttributes(array_keys($attributeLabels));
	}
	
	public function getResponseXML(){
		$butes = $this->getArr();
		return $butes === false ? false : wxDataFormat::arraytoxml($butes);
	}
	
	public function getResponse(){
		$xml = $this->getResponseXML();
		if (!$xml){
			return false;
		}
		
		// 如果是加密方式
		if ($this->EncodingType == weixin::ENCODING_AES){
			$WxSecurity = new WxSecurity();
			list($resBool,$xml) = $WxSecurity->encryptMsg($this->appid, $this->Token,$this->EncodingAESKey, $xml);
			if (!$resBool){
				return false;
			}
		}
		
		return $xml;
	}
	
}

