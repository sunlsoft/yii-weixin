<?php
namespace sunlsoft\yiiweixin\request;


use yii\base\Exception;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestText;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestImage;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestVoice;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestVideo;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestShortvideo;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestLocation;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestLink;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestEventView;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestEventClick;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestEventLocation;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestEventScan;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestEventUnsubscribe;
use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestEventSubscribe;
use yii\base\Component;

/**
 * @author sun
 * @desc   微信的请求接收类
 */
class wxRequest extends Component{
	
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
	 * 文本消息
	 * @var string
	 */
	const MESSAGE_TEXT = "message_text";
	
	/**
	 * 图片消息
	 * @var string
	 */
	const MESSAGE_IMAGE = "message_image";
	
	/**
	 * 语音消息
	 * @var string
	 */
	const MESSAGE_VOICE = "message_voice";
	
	/**
	 * 视频消息
	 * @var string
	 */
	const MESSAGE_VIODE = "message_video";
	
	/**
	 * 小视频消息
	 * @var string
	 */
	const MESSAGE_SHORTVIDEO = "message_shortvideo";
	
	/**
	 * 地理位置消息
	 * @var string
	 */
	const MESSAGE_LOCATION = "message_location";
	
	/**
	 * 链接消息
	 * @var string
	 */
	const MESSAGE_LICK = "message_link";
	
	/**
	 * 关注事件
	 * @var string
	 */
	const EVENT_SUBSCRIBE ="event_subscribe";
	
	/**
	 * 取消关注事件
	 * @var string
	 */
	const EVENT_UNSUBSCRIBE ="event_unsubscribe";

	/**
	 *  用户已关注时的事件推送
	 * @var string
	 */
	const EVENT_SCAN ="event_scan";
	
	/**
	 * 上报地理位置事件
	 * @var string
	 */
	const EVENT_LOCATION ="event_location";
	
	/**
	 * 自定义菜单事件
	 * @var string
	 */
	const EVENT_CLICK ="event_click";
	
	/**
	 * 点击菜单跳转链接时的事件推送
	 * @var string
	 */
	const EVENT_VIEW ="event_view";
	
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
	 * 微信返回的随机数
	 * @var string
	 */
	public $nonce = NULL;
	
	
	/**
	 * 加密模式
	 * @var unknown
	 */
	public $EncodingType = self::ENCODING_TXT;
	
	/**
	 * 不同类型消息对于不同的类
	 * @var array
	 */
	private $_message_type_class = [
			self::MESSAGE_TEXT=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestText',
			],
			self::MESSAGE_IMAGE=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestImage',
			],
			self::MESSAGE_VOICE=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestVoice',
			],
			self::MESSAGE_VIODE=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestVideo',
			],
			self::MESSAGE_SHORTVIDEO=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestShortvideo',
			],
			self::MESSAGE_LOCATION=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestLocation',
			],
			self::MESSAGE_LICK=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestLink',
			],
			self::EVENT_SUBSCRIBE=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestEventSubscribe',
			],
			self::EVENT_UNSUBSCRIBE=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestEventUnsubscribe',
			],
			self::EVENT_SCAN=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestEventScan',
			],
			self::EVENT_LOCATION=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestEventLocation',
			],
			self::EVENT_CLICK=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestEventClick',
			],
			self::EVENT_VIEW=>[
					'class'=>'sunlsoft\\yiiweixin\\request\\wxRequestMessage\\wxRequestEventView',
			],
	];
	

	
	/**
	 * 配置文件中消息类型配置
	 * @var array
	 */
	public $message_type_class = [];
	
	/**
	 * 配置文件中的事件类型
	 * @var array
	 */
	public $event_type_class = [];
	
	
	/**
	 * 消息类型
	 * @var string | False
	 */
	public $message_type = FALSE;
	
	/**
	 * 消息原始内容
	 * @var string
	 */
	public $message_aes_txt = '';
	
	/**
	 * 消息解密后内容
	 * @var array
	 */
	public $message_txt_arr = [];
	
	
	/**
	 * 消息的类型
	 * @var string
	 */
	private $_message_obj ;
	
	public function init(){
		$this->message_aes_txt = file_get_contents("php://input"); 
	}
	

	/**
	 * 设置消息类型的处理方法
	 */
	private function fix(){
		foreach ($this->message_type_class as $key=>$value){
			if (!isset($value['class'])){
				throw new Exception($key." no class");
			}
			if (!isset($value['function'])){
				throw new Exception($key." no function");
			}
			$this->_message_type_class[$key] = ['class'=>$value['class'],'function'=>$value['function']];
		}
		
		foreach ($this->event_type_class as $key=>$value){
			if (!isset($value['class'])){
				throw new Exception($key." no class");
			}
			if (!isset($value['function'])){
				throw new Exception($key." no function");
			}
			$this->_event_type_class[$key] = ['class'=>$value['class'],'function'=>$value['function']];
		}
// 		$this->message_aes_txt = file_get_contents("php://input"); 
		// 如果是加密模式
		if ($this->EncodingType == self::ENCODING_AES){
			$wxEncodingCrypt = new wxEncodingCrypt();
			$wxArr = wxDataFormat::xmltoarray($this->message_aes_txt);
			$msgSignature = isset($wxArr['MsgSignature']) ? $wxArr['MsgSignature'] : '';
			$encrypt = isset($wxArr['Encrypt']) ? $wxArr['Encrypt'] : '';
			$TimeStamp = isset($wxArr['TimeStamp']) ? $wxArr['TimeStamp'] : '';
			$nonce = $this->getNoce();
			list($resBool, $this->message_txt_arr) = $wxEncodingCrypt->decryptMsg( $this->Token,$this->EncodingAESKey, $msgSignature, $TimeStamp,$nonce, $encrypt);
			$this->message_txt_arr = $resBool ?  wxDataFormat::xmltoarray($this->message_txt_arr ) : [];
			
		}else {
			$this->message_txt_arr = wxDataFormat::xmltoarray($this->message_aes_txt);
		}
		
		
		parent::init();
	}
	
	
	public function getMesssageAesTxt(){
		return $this->message_aes_txt;
	}
	
	public function setMessageAesTxt($txt){
		$this->message_aes_txt = $txt;
	}
	
	public function setNonce($nonce){
		$this->nonce = $nonce;
	}
	
	public function getNoce(){
		if ($this->nonce === null){
			$this->nonce = \Yii::$app->request->get('nonce');
		}
		return $this->nonce;
	}
	
	/**
	 * 文本消息
	 * @return wxRequestText
	 */
	public function getMessageText(){
		
		return $this->getmessage(self::MESSAGE_TEXT);
	}
	
	
	/**
	 * 图片消息
	 * @return wxRequestImage
	 */
	public function getMessageImage(){
		return $this->getmessage(self::MESSAGE_IMAGE);
	}
	
	/**
	 * 图片消息
	 * @return wxRequestVoice
	 */
	public function getMessageVoice(){
		return $this->getmessage(self::MESSAGE_VOICE);
	}
	
	/**
	 * 视频消息
	 * @return wxRequestVideo
	 */
	public function getMessageVideo(){
		$typeName = 'video';
		return $this->getmessage(self::MESSAGE_VIODE);
	}
	
	/**
	 * 小视频消息
	 * @return wxRequestShortvideo
	 */
	public function getMessageShortvideo(){
		return $this->getmessage(self::MESSAGE_SHORTVIDEO);
	}
	
	/**
	 * 地理位置消息
	 * @return wxRequestLocation
	 */
	public function getMessageLocation(){
		return $this->getmessage(self::MESSAGE_LOCATION);
	}
	
	/**
	 * 链接消息
	 * @return wxRequestLink
	 */
	public function getMessageLink(){
		return $this->getmessage(self::MESSAGE_LICK);
	}
	
	
	/**
	 * 关注事件
	 * @return wxRequestEventSubscribe
	 */
	public function getMessageEventSubscribe(){
		return $this->getmessage(self::EVENT_SUBSCRIBE);
	}
	
	/**
	 * 取消关注事件
	 * @return wxRequestEventUnsubscribe
	 */
	public function getMessageEventUnsubscribe(){
		return $this->getmessage(self::EVENT_UNSUBSCRIBE);
	}
	
	/**
	 * 用户已关注时的事件推送
	 * @return wxRequestEventScan
	 */
	public function getMessageEventScan(){
		return $this->getmessage(self::EVENT_SCAN);
	}
	
	/**
	 * 上报地理位置事件
	 * @return wxRequestEventLocation
	 */
	public function getMessageEventLocation(){
		return $this->getmessage(self::EVENT_LOCATION);
	}
	
	/**
	 * 自定义菜单事件-点击菜单拉取消息时的事件推送
	 * @return wxRequestEventClick
	 */
	public function getMessageEventClick(){
		return $this->getmessage(self::EVENT_CLICK);
	}
	
	
	/**
	 * 自定义菜单事件-点击菜单跳转链接时的事件推送
	 * @return wxRequestEventView
	 */
	public function getMessageEventView(){
		return $this->getmessage(self::EVENT_VIEW);
		
	}
	
	/**
	 * 底层获取不同消息的类型
	 * @param string $typeName
	 * @return object
	 */
	private function getmessage($typeName){
		$this->fix();
		$className = $this->_message_type_class[$typeName]['class'];
		$type = $this->message_txt_arr;
		$type['class'] = $className;
	
		$object =  \Yii::createObject($className);
		foreach ($this->message_txt_arr as $k=>$v){
			isset($object->$k) ? $object->$k = $v : '';
		}
		return $object;
		
	}
	
	
}

