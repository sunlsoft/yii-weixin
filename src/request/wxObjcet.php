<?php
namespace sunlsoft\yiiweixin\request;


use yii\base\Component;

/**
 * 微信的基础类
 * @author sun
 *
 */
class wxObjcet extends Component{
	

	
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
	public $EncodingType = 1;
	
	/**
	 * 微信请求接收类
	 * @var wxRequest|array|string|callable
	 */
	public $wxRequest = 'sunlsoft\yiiweixin\request\wxRequest';
	
	/**
	 * 微信请求接收类的参数信息
	 * @var array
	 */
	public $wxRequestParams = [];
	
	
	/**
	 * 获取微信请求接收类
	 * @return wxRequest
	 */
	public function getWxRequest(){
		
		if (!is_object($this->wxRequest)){
			$this->wxRequestParams['appid'] = $this->appid;
			$this->wxRequestParams['Token'] = $this->Token;
			$this->wxRequestParams['EncodingAESKey'] = $this->EncodingAESKey;
			$this->wxRequestParams['EncodingType'] = $this->EncodingType;
			$this->wxRequestParams['class'] = $this->wxRequest;
			$this->wxRequest = \Yii::createObject($this->wxRequestParams);
		}
		
		return $this->wxRequest;
	}
	
	
	
}

