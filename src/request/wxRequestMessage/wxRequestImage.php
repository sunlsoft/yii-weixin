<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

use sunlsoft\yiiweixin\request\wxRequestMessage\wxRequestBaseObjct;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
 * @desc   微信消息-图片消息
 */
class wxRequestImage extends wxRequestBaseObjct{
	
	/**
	 * 图片链接（由系统生成）
	 * @var string
	 */
	public $PicUrl = '';
	
	/**
	 * 图片消息媒体id
	 * @var int
	 */
	public $MediaId = 0;
}

