<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140454
 * @desc   微信消息-事件-取消事件
 */
class wxRequestEventScan extends wxRequestBaseObjct{
	
	/**
	 * 事件类型
	 * @var string
	 */
	public $Event = 'SCAN';
	
	/**
	 * 扫描二维码关注时候 事件KEY值，qrscene_为前缀，后面为二维码的参数值
	 * @var string
	 */
	public $EventKey = '';
	
	/**
	 * 扫描二维码关注时候 二维码的ticket，可用来换取二维码图片
	 * @var string
	 */
	public $Ticket = '';
	
	
}

