<?php
namespace  sunlsoftunit\extensions\weixin;

use sunlsoftunit\extensions\weixin\TestCase;
use sunlsoft\yiiweixin\request\wxObjcet;
use sunlsoft\yiiweixin\request\wxDataFormat;
use sunlsoft\yiiweixin\request\wxEncodingCrypt;
use sunlsoft\yiiweixin\request\wxRequest;


class wxRequestTest extends TestCase{
	
	public function testGetMessageText(){
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'text',
				"Content"=>'Content',
				"MsgId"=>200,
		];
		

		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$MessageText = $wxRequest->getMessageText();
		
		$this->check($arr, $MessageText);

	}
	
	public function testDMessageText(){
		$wxObjcet =  new wxObjcet();
		$XML = "<xml><ToUserName><![CDATA[oia2Tj我是中文123123jewbmiOUlr6X-1crbLOvLw]]></ToUserName><FromUserName><![CDATA[gh_7f083739789a]]></FromUserName><CreateTime>1407743423</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[eYJ1MbwPRJtOvIEabaxHs7TX2D-HV71s79GUxqdUkjm6Gs2Ed1KF3ulAOA9H1xG0]]></MediaId><Title><![CDATA[testCallBackReplyVideo]]></Title><Description><![CDATA[testCallBackReplyVideo]]></Description></Video></xml>";
		
		$wxObjcet->appid = 'wxb11529c136998cb6';
		$wxObjcet->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$wxObjcet->Token = 'pamtest';
		$wxObjcet->EncodingType = 2;
		
		$wxEncodingCrypt = new wxEncodingCrypt();
		
		$xmlArr = wxDataFormat::xmltoarray($XML);		
		
		list($resBool,$txt) = $wxEncodingCrypt->encryptMsg($wxObjcet->appid, $wxObjcet->Token,$wxObjcet->EncodingAESKey, $XML);
		
		$this->assertTrue($resBool,"加密失败");
		
		
		$arr = wxDataFormat::xmltoarray($txt);
		
		$wxRequest = new wxRequest();
		$wxRequest->appid = 'wxb11529c136998cb6';
		$wxRequest->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$wxRequest->Token = 'pamtest';
		$wxRequest->EncodingType = 2;
		$wxRequest->setMessageAesTxt($txt);
		$wxRequest->setNonce($arr['Nonce']);
		
		
// 		\Yii::$app->request->setQueryParams(['nonce'=>$arr['Nonce']]);
		$rest = $wxRequest->getMessageText();

		
		
		list($encodingBool,$txt) = $wxEncodingCrypt->decryptMsg( $wxObjcet->Token,$wxObjcet->EncodingAESKey, $arr['MsgSignature'], $arr['TimeStamp'],$arr['Nonce'], $arr['Encrypt']);
		
		$this->assertTrue($encodingBool,"解密失败");
		
		
	}
	
	
	public function testGetMessageImage(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'image',
				"PicUrl"=>'PicUrl',
				"MediaId"=>230,
				"MsgId"=>200,
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageImage();
		$this->check($arr, $obj);
		
	}
	
	public function testGetMessageVoice(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'voice',
				"Format"=>'amr',
				"Recognition"=>"Recognition",
				"MediaId"=>230,
				"MsgId"=>200,
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageVoice();
		$this->check($arr, $obj);
		
		
	}
	
	public function testGetMessageVideo(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'video',
				"ThumbMediaId"=>100,
				"MsgId"=>200,
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageVideo();
		$this->check($arr, $obj);
		
		
	}
	
	public function testGetMessageShortvideo(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'shortvideo',
				"ThumbMediaId"=>100,
				"MsgId"=>200,
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageShortvideo();
		$this->check($arr, $obj);
		
		
	}
	
	public function testGetMessageLocation(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'location',
				"Location_X"=>20.1,
				"Location_Y"=>20.1,
				"Scale"=>20,
				"Label"=>"Label",
				"MsgId"=>200,
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageLocation();
		$this->check($arr, $obj);
		
		
	}
	
	public function testGetMessageLink(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'link',
				"Title"=>'Title',
				"Description"=>'Description',
				"Url"=>'Url',
				"MsgId"=>200,
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageLink();
		$this->check($arr, $obj);
		
	}
	
	public function testGetMessageEventSubscribe(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'event',
				"Event"=>'subscribe',
				"EventKey"=>"qrscene_EventKey",
				"Ticket"=>"Ticket"
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageEventSubscribe();
		$this->check($arr, $obj);
		
		
	}
	
	public function getMessageEventUnsubscribe(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'event',
				"Event"=>'unsubscribe',
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageEventUnsubscribe();
		$this->check($arr, $obj);
		
	}
	
	public function getMessageEventScan(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'event',
				"Event"=>'SCAN',
				"EventKey"=>"qrscene_EventKey",
				"Ticket"=>"Ticket"
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageEventScan();
		$this->check($arr, $obj);
		
		
	}
	
	public function getMessageEventLocation(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'event',
				"Event"=>'LOCATION',
				"Latitude"=>20.1,
				"Longitude"=>20.2,
				"Precision"=>119.385040
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageEventLocation();
		$this->check($arr, $obj);
		
		
	}
	
	public function getMessageEventClick(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'event',
				"Event"=>'CLICK',
				"EventKey"=>'EventKey',
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageEventClick();
		$this->check($arr, $obj);
		
	}
	
	public function getMessageEventView(){
		$arr = [
				"ToUserName"=>"ToUserName",
				"FromUserName"=>"FromUserName",
				"CreateTime"=>100,
				"MsgType"=>'event',
				"Event"=>'VIEW',
				"EventKey"=>'EventKey',
		];
// 		file_get_contents("php://input") = wxDataFormat::arraytoxml($this->getMessageText());
		$wxObjcet =  new wxObjcet();
		$wxRequest = $wxObjcet->getWxRequest();
		
		$wxRequest->setMessageAesTxt(wxDataFormat::arraytoxml($arr));
		$obj = $wxRequest->getMessageEventView();
		$this->check($arr, $obj);
		
	}
	
	
// 	public function testMessage(){
// 		$this->getMessageText();
// 		$this->getMessageImage();
		
// 		return false;
// 	}
	
	private function check($arr,$obj){
		foreach ($arr as $k=>$v){
			$this->assertEquals($obj->$k,$arr[$k],$k."不正确");
		}
	
	}
}

