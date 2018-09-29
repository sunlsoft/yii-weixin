<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140454
 * @desc   微信消息-事件-取消事件
 */
class wxRequestEventUnsubscribe extends wxRequestBaseObjct{
	
	/**
	 * 事件类型
	 * @var string
	 */
	public $Event = 'unsubscribe';
	
	
}

