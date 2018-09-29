<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
 * @desc   微信消息-文本消息
 */
class wxRequestText extends wxRequestBaseObjct{
	
	/**
	 * 文本消息内容
	 * @var string
	 */
	public $Content = '';
}

