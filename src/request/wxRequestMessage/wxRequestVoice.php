<?php
namespace sunlsoft\yiiweixin\request\wxRequestMessage;

/**
 * @author sun
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
 * @desc   微信消息-语音消息
 */
class wxRequestVoice extends wxRequestBaseObjct{
	
	/**
	 * 语音格式，如amr，speex等
	 * @var string
	 */
	public $Format = '';
	
	/**
	 * 图片消息媒体id
	 * @var int
	 */
	public $MediaId = 0;
	
	/**
	 * 语音识别结果，UTF8编码 开启语音识别后
	 * @var string
	 */
	public $Recognition = '';
}

