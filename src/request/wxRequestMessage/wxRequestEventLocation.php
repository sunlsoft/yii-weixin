<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140454
 * @desc   微信消息-事件-上报地理位置事件
 */
class wxRequestEventLocation extends wxRequestBaseObjct{
	
	/**
	 * 事件类型
	 * @var string
	 */
	public $Event = 'LOCATION';
	
	/**
	 * 地理位置纬度
	 * @var string
	 */
	public $Latitude = '';
	
	/**
	 * 地理位置经度
	 * @var string
	 */
	public $Longitude = '';
	
	/**
	 * 地理位置精度
	 * @var string
	 */
	public $Precision = '';
	
	
}

