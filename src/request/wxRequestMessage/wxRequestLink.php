<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
 * @desc   微信消息-链接消息
 */
class wxRequestLink extends wxRequestBaseObjct{
	
	/**
	 * 消息标题
	 * @var string
	 */
	public $Title = '';
	
	/**
	 * 消息描述
	 * @var string
	 */
	public $Description = '';
	
	/**
	 * 消息链接
	 * @var string
	 */
	public $Url = '';
	
}

