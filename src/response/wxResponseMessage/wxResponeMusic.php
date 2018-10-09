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
	
	
	public function rules(){
		$parentRules = parent::rules();
		array_push($parentRules, 
				[['ThumbMediaId','MsgType'], 'required'],
				[['Title','Description'], 'string'],
				[['MusicURL','HQMusicUrl'], 'string']
		);
		
		return $parentRules;
	}
	
	public function attributeLabels(){
		return [
				'ThumbMediaId' => '通过素材管理中的接口上传多媒体文件，得到的id。',
				'MsgType'=>'消息的类型',
				'Title'=>'音乐标题',
				'Description'=>'音乐描述',
				'MusicURL'=>'音乐链接',
				'HQMusicUrl'=>'高质量音乐链接，WIFI环境优先使用该链接播放音乐',
				'ThumbMediaId'=>'缩略图的媒体id，通过素材管理中的接口上传多媒体文件，得到的id'
		];
	}
	
	
}

