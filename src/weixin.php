<?php
namespace sunlsoft\yiiweixin;

use yii\base\Component;
use sunlsoft\yiiweixin\request\wxRequest;
use sunlsoft\yiiweixin\response\wxResponse;
use sunlsoft\yiiweixin\base\WxSecurity;
use sunlsoft\yiiweixin\base\wxDataFormat;


class weixin extends Component{
	
	/**
	 * 明文加密
	 * @var int
	 */
	const ENCODING_TXT = 1;
	
	/**
	 * 密文加密
	 * @var int
	 */
	const ENCODING_AES = 2;
	
	/**
	 * 兼容模式
	 * @var integer
	 */
	const ENCODING_AUTO = 3;
	
	
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
	public $EncodingType = self::ENCODING_TXT;
	
	
	/**
	 * 消息解密后内容
	 * @var array
	 */
	public $message_txt_arr = [];
	
	/**
	 * 消息原始数据
	 * @var string
	 */
	public $message_aes_txt = '';
	
	/**
	 * 微信返回的随机数
	 * @var string
	 */
	public $requestNonce = NULL;
	
	/**
	 * 用户微信号的openId
	 * @var string
	 */
	public $openId = '';
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = FALSE;
	
	/**
	 * 事件类型
	 * @var string
	 */
	public $Event = FALSE;
	
	
	
	/**
	 * 微信响应类
	 * @var wxRequest
	 */
	private $_request = 'sunlsoft\yiiweixin\request\wxRequest';
	
	
	/**
	 * 微信的请求类
	 * @var wxResponse
	 */
	private $_response = 'sunlsoft\yiiweixin\response\wxResponse';
	
	
	
	
	/**
	 * 解密微信的加密信息
	 */
	private function getMessageTxtArr(){
		if ($this->EncodingType == weixin::ENCODING_AES){
			$WxSecurity = new WxSecurity();
			$wxArr = wxDataFormat::xmltoarray($this->getMesssageAesTxt());
			$msgSignature = isset($wxArr['MsgSignature']) ? $wxArr['MsgSignature'] : '';
			$encrypt = isset($wxArr['Encrypt']) ? $wxArr['Encrypt'] : '';
			$TimeStamp = isset($wxArr['TimeStamp']) ? $wxArr['TimeStamp'] : '';
			$nonce = $this->getRequestNonce();
			list($resBool, $this->message_txt_arr) = $WxSecurity->decryptMsg( $this->Token,$this->EncodingAESKey, $msgSignature, $TimeStamp,$nonce, $encrypt);
			$this->message_txt_arr = $resBool ?  wxDataFormat::xmltoarray($this->message_txt_arr ) : [];
		}else {
			$this->message_txt_arr = wxDataFormat::xmltoarray($this->getMesssageAesTxt());
		}
		$this->openId = isset($this->message_txt_arr['FromUserName']) ? $this->message_txt_arr['FromUserName'] : '';
		$this->MsgType = isset($this->message_txt_arr['MsgType']) ? $this->message_txt_arr['MsgType'] : '';
		$this->Event = isset($this->message_txt_arr['Event']) ? $this->message_txt_arr['Event'] : '';
		
		return $this->message_txt_arr;
	}
	
	
	public function getMesssageAesTxt(){
		if (empty($this->message_aes_txt)){
			$this->message_aes_txt = file_get_contents("php://input");
		}
		return $this->message_aes_txt;
	}
	
	public function setMessageAesTxt($txt){
		$this->message_aes_txt = $txt;
	}
	
	public function setRequestNonce($nonce){
		$this->requestNonce = $nonce;
	}
	
	public function getRequestNonce(){
		if ($this->requestNonce === null){
			$this->requestNonce = \Yii::$app->request->get('nonce');
		}
		return $this->requestNonce;
	}
	
	
	
	public function getRequest(){
		if (!is_object($this->_request)){
			$arr['class'] = $this->_request;
			$arr['appid'] = $this->appid;
			$arr['Token'] = $this->Token;
			$arr['EncodingAESKey'] = $this->EncodingAESKey;
			$arr['EncodingType'] = $this->EncodingType;
			$this->_request= \Yii::createObject($arr);
			$this->_request->message_txt_arr = $this->getMessageTxtArr();
		}
		return $this->_request;
	}
	
	public function getResponse(){
		if (!is_object($this->_response)){
			$this->getMessageTxtArr();
			$arr['class'] = $this->_response;
			$arr['appid'] = $this->appid;
			$arr['Token'] = $this->Token;
			$arr['EncodingAESKey'] = $this->EncodingAESKey;
			$arr['EncodingType'] = $this->EncodingType;
			$arr['openId'] = $this->openId;
			$this->_response= \Yii::createObject($arr);
		}
		
		return $this->_response;
	}
	
	
	
}

