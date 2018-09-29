<?php
namespace  sunlsoftunit\extensions\weixin;

use sunlsoftunit\extensions\weixin\TestCase;
use sunlsoft\yiiweixin\request\wxObjcet;
use sunlsoft\yiiweixin\request\wxDataFormat;


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

