<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140454
 * @desc   微信消息-事件-自定义菜单事件-点击菜单拉取消息时的事件推送
 */
class wxRequestEventClick extends wxRequestBaseObjct{
	
	/**
	 * 事件类型
	 * @var string
	 */
	public $Event = 'CLICK';
	
	/**
	 * 事件KEY值，与自定义菜单接口中KEY值对应
	 * @var string
	 */
	public $EventKey = '';

}

