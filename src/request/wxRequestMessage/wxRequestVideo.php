<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
 * @desc   微信消息-视频消息
 */
class wxRequestVideo extends wxRequestBaseObjct{
	
	/**
	 * 视频消息缩略图的媒体id，可以调用多媒体文件下载接口拉取数据。
	 * @var int
	 */
	public $ThumbMediaId = 0;
	
	/**
	 * 图片消息媒体id
	 * @var int
	 */
	public $MediaId = 0;
	

}

