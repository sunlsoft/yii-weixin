<?php

namespace sunlsoft\yiiweixin\response\wxResponseMessage;


/**
 * 回复视频消息
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140543
 * @author sun
 *
 */
class wxResponeVideo extends wxResponseBaseObjct{
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = 'video';
	
	/**
	 * 通过素材管理中的接口上传多媒体文件，得到的id
	 * @var unknown
	 */
	public $MediaId;
	
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
	
	
	public function rules(){
		$parentRules = parent::rules();
		array_push($parentRules,[['MsgType', 'MediaId','Title','Description'], 'required']);
		
		return $parentRules;
	}
	
	public function attributeLabels(){
		$attributeLabels = parent::attributeLabels();
		$new =  [
				'MsgType'=>'消息的类型',
				'MediaId'=>'通过素材管理中的接口上传多媒体文件，得到的id。',
				'Title'=>"视频消息的标题",
				'Description'=>"视频消息的描述"
		];
		
		$attributeLabels = array_merge($attributeLabels,$new);
		return $attributeLabels;
	}
	
}

