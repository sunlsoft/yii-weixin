<?php

namespace sunlsoft\yiiweixin\response\wxResponseMessage;

/**
 * 回复音乐消息
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140543
 * @author sun
 *
 */
class wxResponeMusic extends wxResponseBaseObjct{
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = 'music';
	
	
	/**
	 * 视频消息的标题
	 * @var string
	 */
	public $Title = '';
	
	/**
	 * 视频消息的描述
	 * @var string
	 */
	public $Description = '';
	
	/**
	 * 音乐链接
	 * @var string
	 */
	public $MusicURL = '';
	
	/**
	 * 高质量音乐链接，WIFI环境优先使用该链接播放音乐
	 * @var string
	 */
	public $HQMusicUrl = '';
	
	/**
	 * 缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id
	 * @var string
	 */
	public $ThumbMediaId = '';
	
	public function getArr(){
		$arr = $this->getBaseArr();
		$arr['MsgType'] = $this->MsgType;
		$arr['Title'] = $this->Title;
		$arr['Description'] = $this->Description;
		$arr['MusicURL'] = $this->MusicURL;
		$arr['HQMusicUrl'] = $this->HQMusicUrl;
		$arr['ThumbMediaId'] = $this->ThumbMediaId;
		return $arr;
	}
}

