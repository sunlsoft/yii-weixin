<?php

namespace sunlsoft\yiiweixin\response\wxResponseMessage;

/**
 * 回复文本消息
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140543
 * @author sun
 *
 */
class wxResponeText extends wxResponseBaseObjct{
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = 'text';
	
	/**
	 * 回复的消息内容（换行：在content中能够换行，微信客户端就支持换行显示）
	 * @var unknown
	 */
	public $Content;
	
	public function getArr(){
		$arr = $this->getBaseArr();
		$arr['MsgType'] = $this->MsgType;
		$arr['Content'] = $this->Content;
		return $arr;
	}
}

