<?php

namespace sunlsoft\yiiweixin\response;

use yii\base\Component;
use sunlsoft\yiiweixin\weixin;
use sunlsoft\yiiweixin\response\wxResponseMessage\wxResponeText;
use sunlsoft\yiiweixin\response\wxResponseMessage\wxResponeImage;
use sunlsoft\yiiweixin\response\wxResponseMessage\wxResponeVoice;
use sunlsoft\yiiweixin\response\wxResponseMessage\wxResponeVideo;
use sunlsoft\yiiweixin\response\wxResponseMessage\wxResponeMusic;
use sunlsoft\yiiweixin\response\wxResponseMessage\wxResponeNews;

class wxResponse extends Component{
	
	/**
	 * 文本消息
	 * @var string
	 */
	const MESSAGE_TEXT = 'text';
	
	/**
	 * 图片消息
	 * @var string
	 */
	const MESSAGE_IMAGE = 'image';
	
	/**
	 * 语音消息
	 * @var string
	 */
	const MESSAGE_VOICE = 'voice';
	
	/**
	 * 视频消息
	 * @var string
	 */
	const MESSAGE_VIDEO = 'video';
	
	/**
	 * 音乐消息
	 * @var string
	 */
	const MESSAGE_MUSIC = 'music';
	
	/**
	 * 图文消息
	 * @var string
	 */
	const MESSAGE_NEWS = 'news';
	
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
	 * 用户的openId
	 * @var string
	 */
	public $openId = '';
	
	/**
	 * 加密模式
	 * @var unknown
	 */
	public $EncodingType = weixin::ENCODING_TXT;
	
	/**
	 * 不同类型消息对于不同的类
	 * @var array
	 */
	private $_message_type_class = [
			self::MESSAGE_TEXT=>[
					'class'=>'sunlsoft\\yiiweixin\\response\\wxResponseMessage\\wxResponeText',
			],
			self::MESSAGE_IMAGE=>[
					'class'=>'sunlsoft\\yiiweixin\\response\\wxResponseMessage\\wxResponeImage',
			],
			self::MESSAGE_VOICE=>[
					'class'=>'sunlsoft\\yiiweixin\\response\\wxResponseMessage\\wxResponeVoice',
			],
			self::MESSAGE_VIDEO=>[
					'class'=>'sunlsoft\\yiiweixin\\response\\wxResponseMessage\\wxResponeVideo',
			],
			self::MESSAGE_MUSIC=>[
					'class'=>'sunlsoft\\yiiweixin\\response\\wxResponseMessage\\wxResponeMusic',
			],
			self::MESSAGE_NEWS=>[
					'class'=>'sunlsoft\\yiiweixin\\response\\wxResponseMessage\\wxResponeNews',
			]
	];
	
	/**
	 * 回复文本消息
	 * @return wxResponeText
	 */
	public function getResponseText(){
		return $this->getResponseObjce(self::MESSAGE_TEXT);
	}
	
	/**
	 * 回复图片消息
	 * @return wxResponeImage
	 */
	public function getResponseImage(){
		return $this->getResponseObjce(self::MESSAGE_IMAGE);
	}
	
	/**
	 * 回复语音消息
	 * @return wxResponeVoice
	 */
	public function getResponseVoice(){
		return $this->getResponseObjce(self::MESSAGE_VOICE);
	}
	
	/**
	 * 回复视频消息
	 * @return wxResponeVideo
	 */
	public function getResponseVideo(){
		return $this->getResponseObjce(self::MESSAGE_VIDEO);
	}
	
	/**
	 * 回复音乐消息
	 * @return wxResponeMusic
	 */
	public function getResponseMusic(){
		return $this->getResponseObjce(self::MESSAGE_MUSIC);
	}
	
	/**
	 * 回复图文消息
	 * @return wxResponeNews
	 */
	public function getResponseNews(){
		return $this->getResponseObjce(self::MESSAGE_NEWS);
	}
	
	private function getResponseObjce($type){
		$arr['class'] = $this->_message_type_class[$type]['class'];
		$arr['FromUserName'] = $this->appid;
		$arr['EncodingType'] = $this->EncodingType;
		$arr['EncodingAESKey'] = $this->EncodingAESKey;
		$arr['Token'] = $this->Token;
		$arr['appid'] = $this->appid;
		$arr['ToUserName'] = $this->openId;
		return \Yii::createObject($arr);
	}
	
}

