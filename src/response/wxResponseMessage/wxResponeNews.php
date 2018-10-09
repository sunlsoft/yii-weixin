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
	 * 图文消息标题
	 * @var string
	 */
	// public $Title = '';
	
	/**
	 * 图文消息描述
	 * @var string
	 */
	// public $Description = '';
	
	/**
	 * 图片链接，支持JPG、PNG格式，较好的效果为大图360*200，小图200*200
	 * @var string
	 */
	// public $PicUrl = '';
	
	/**
	 * 点击图文消息跳转链接
	 * @var string
	 */
	// public $Url = '';
	
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
	
	public function getArr(){
		$arr = $this->getBaseArr();
		$arr['MsgType'] = $this->MsgType;
		$arr['ArticleCount'] = $this->ArticleCount;
		$arr['Articles'] = $this->Articles;
// 		$arr['Title'] = $this->Title;
// 		$arr['Description'] = $this->Description;
// 		$arr['PicUrl'] = $this->PicUrl;
// 		$arr['Url'] = $this->Url;
		return $arr;
	}
}

