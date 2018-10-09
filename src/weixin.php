<?php
namespace sunlsoft\yiiweixin;

use yii\base\Component;
use sunlsoft\yiiweixin\request\wxRequest;
use sunlsoft\yiiweixin\response\wxResponse;


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
	 * 微信响应类
	 * @var wxRequest
	 */
	private $_request = 'sunlsoft\yiiweixin\request\wxRequest';
	
	
	/**
	 * 微信的请求类
	 * @var wxResponse
	 */
	private $_response = 'sunlsoft\yiiweixin\response\wxResponse';
	
	
	
	public function getRequest(){
		if (!is_object($this->_request)){
			$arr['class'] = $this->_request;
			$arr['appid'] = $this->appid;
			$arr['Token'] = $this->Token;
			$arr['EncodingAESKey'] = $this->EncodingAESKey;
			$arr['EncodingType'] = $this->EncodingType;
			$this->_request= \Yii::createObject($arr);
		}
		return $this->_request;
	}
	
	public function getResponse(){
		if (!is_object($this->_response)){
			$arr['class'] = $this->_response;
			$arr['appid'] = $this->appid;
			$arr['Token'] = $this->Token;
			$arr['EncodingAESKey'] = $this->EncodingAESKey;
			$arr['EncodingType'] = $this->EncodingType;
			$this->_response= \Yii::createObject($arr);
		}
		
		return $this->_response;
	}
	
	
	
}

