<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
 * @desc   微信消息-地理位置消息
 */
class wxRequestLocation extends wxRequestBaseObjct{
	
	/**
	 * 地理位置维度
	 * @var float
	 */
	public $Location_X = 0.00;
	
	/**
	 * 地理位置经度
	 * @var float
	 */
	public $Location_Y = 0;
	
	/**
	 * 地图缩放大小
	 * @var int
	 */
	public $Scale = 0;
	
	/**
	 * 地理位置信息
	 * @var string
	 */
	public $Label = '';
	

}

