<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;


use yii\base\Component;

/**
 * @author sun
 * @desc   微信消息体基础类
 */
class wxRequestBaseObjct extends Component{
	
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
	 * 消息创建时间 （整型）
	 * @var int
	 */
	public $CreateTime = 0;
	
	/**
	 * 消息的类型
	 * @var string
	 */
	public $MsgType = '';
	
	/**
	 * 消息id
	 * @var int
	 */
	public $MsgId = 0;
	
}

