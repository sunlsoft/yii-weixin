<?php

namespace sunlsoft\yiiweixin\response\wxResponseMessage;


/**
 * 回复语音消息
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140543
 * @author sun
 *
 */
class wxResponeVoice extends wxResponseBaseObjct{
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = 'voice';
	
	/**
	 * 通过素材管理中的接口上传多媒体文件，得到的id
	 * @var unknown
	 */
	public $MediaId;
	
	public function getArr(){
		$arr = $this->getBaseArr();
		$arr['MsgType'] = $this->MsgType;
		$arr['MediaId'] = $this->MediaId;
		return $arr;
	}
}

