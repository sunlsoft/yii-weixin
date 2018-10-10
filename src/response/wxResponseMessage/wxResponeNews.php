<?php

namespace sunlsoft\yiiweixin\response\wxResponseMessage;

/**
 * 回复图文消息
 * @link https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140543
 * @author sun
 *
 */
class wxResponeNews extends wxResponseBaseObjct{
	
	/**
	 * 消息类型
	 * @var string
	 */
	public $MsgType = 'news';
	
	/**
	 * 回复的消息内容（换行：在content中能够换行，微信客户端就支持换行显示）
	 * @var unknown
	 */
	public $ArticleCount = 0;
	
	/**
	 * 图文消息信息，注意，如果图文数超过1，则将只发第1条
	 * @var string
	 */
	public $Articles = [];
	
	/**
	 * 添加文章
	 * @param unknown $Title
	 * @param unknown $Description
	 * @param unknown $PicUrl
	 * @param unknown $Url
	 * @return boolean
	 */
	public function sendArticle($Title,$Description,$PicUrl,$Url){
		$this->ArticleCount++;
		$this->Articles[] = [
				'item'=>[
					'Title'=>$Title,
					'Description'=>$Description,
					'PicUrl'=>$PicUrl,
					'Url'=>$Url,
				]
		];
		return true;
	}
	
	public function rules(){
		$parentRules = parent::rules();
		array_push($parentRules,[['ArticleCount', 'MsgType','Articles'], 'required']);
		
		return $parentRules;
	}
	
	public function attributeLabels(){
		$attributeLabels = parent::attributeLabels();
		$new = [
				'ArticleCount' => '图文消息个数，限制为1条以内',
				'MsgType'=>'消息的类型',
				'Articles'=>'图文消息信息',
		];
		
		$attributeLabels = array_merge($attributeLabels,$new);
		return $attributeLabels;
	}
	

}

