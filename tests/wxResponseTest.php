<?php
namespace  sunlsoftunit\extensions\weixin;

use sunlsoft\yiiweixin\weixin;

class wxResponseTest extends TestCase{
	
	public function testSendText(){
		$weixin =  new weixin();
		$weixin->appid = 'wxb11529c136998cb6';
		$weixin->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$weixin->Token = 'pamtest';
		
		$wxResponse = $weixin->getResponse();
		
		$textMessage = $wxResponse->getResponseText();
		$textMessage->Content = '111';
		
		$RES = $textMessage->getResponse();
		
		$this->assertNotFalse($RES,'Text 加密失败');
	}
	
	public function testSendImage(){
		$weixin =  new weixin();
		$weixin->appid = 'wxb11529c136998cb6';
		$weixin->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$weixin->Token = 'pamtest';
		
		$wxResponse = $weixin->getResponse();
		$obj = $wxResponse->getResponseImage();
		$obj->MediaId = 100;
		
		$RES = $obj->getResponse();
		
		$this->assertNotFalse($RES,'Image 加密失败');
	}
	
	public function testSendVoice(){
		$weixin =  new weixin();
		$weixin->appid = 'wxb11529c136998cb6';
		$weixin->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$weixin->Token = 'pamtest';
		
		$wxResponse = $weixin->getResponse();
		$obj = $wxResponse->getResponseVoice();
		$obj->MediaId = 100;
		
		$RES = $obj->getResponse();
		
		$this->assertNotFalse($RES,'Voice 加密失败');
	}
	
	public function testSendVideo(){
		$weixin =  new weixin();
		$weixin->appid = 'wxb11529c136998cb6';
		$weixin->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$weixin->Token = 'pamtest';
		
		$wxResponse = $weixin->getResponse();
		$obj = $wxResponse->getResponseVideo();
		$obj->MediaId = 100;
		$obj->Title = '11';
		$obj->Description = 'Description';
		
		$RES = $obj->getResponse();
		
		$this->assertNotFalse($RES,'Video 加密失败');
	}
	
	public function testSendMusic(){
		$weixin =  new weixin();
		$weixin->appid = 'wxb11529c136998cb6';
		$weixin->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$weixin->Token = 'pamtest';
		
		$wxResponse = $weixin->getResponse();
		$obj = $wxResponse->getResponseMusic();;
		
		$obj->Title = '11';
		$obj->Description = 'Description';
		$obj->MusicURL = 'MusicURL';
		$obj->HQMusicUrl = 'HQMusicUrl';
		$obj->ThumbMediaId = 100;
		
		
		
		$RES = $obj->getResponse();
		
		$this->assertNotFalse($RES,'Music 加密失败');
	}
	
	public function testSendNews(){
		$weixin =  new weixin();
		$weixin->appid = 'wxb11529c136998cb6';
		$weixin->EncodingAESKey = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG';
		$weixin->Token = 'pamtest';
		
		$wxResponse = $weixin->getResponse();
		$obj = $wxResponse->getResponseNews();
		
		$obj->sendArticle('title', '$Description', '$PicUrl', '$Url');
		$obj->sendArticle('title11', '$Description', '$PicUrl', '$Url');
		
		
		$RES = $obj->getResponse();
		
		$this->assertNotFalse($RES,'文本加密失败');
	}
}

