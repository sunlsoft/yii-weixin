<?php

namespace sunlsoft\yiiweixin\response\wxResponseMessage;

/**
 * 回复图片消息
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140543
 * @author sun
 *
 */
class wxResponeImage extends wxResponseBaseObjct{
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = 'image';
	
	/**
	 * 通过素材管理中的接口上传多媒体文件，得到的id。
	 * @var unknown
	 */
	public $MediaId;
	
	
	public function rules(){
		$parentRules = parent::rules();
		array_push($parentRules, [['MediaId', 'MsgType'], 'required']);
		
		return $parentRules;
	}
	
	public function attributeLabels(){	
		$attributeLabels = parent::attributeLabels();
		$new = [
				'MediaId' => '通过素材管理中的接口上传多媒体文件，得到的id。',
				'MsgType'=>'消息的类型',
		];
		
		$attributeLabels = array_merge($attributeLabels,$new);
		return $attributeLabels;
	}
	
}

