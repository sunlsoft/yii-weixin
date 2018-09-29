<?php
namespace sunlsoft\yiiweixin\request;

use yii\base\BaseObject;

/**
 * 微信数据格式转换
 * @author sun
 *
 */
class wxDataFormat extends BaseObject{
	
	/**
	 * 微信的xml格式转换成数组
	 * @param sting $xml
	 * @return array
	 */
	public static function xmltoarray($xml) {
		//禁止引用外部xml实体
		libxml_disable_entity_loader(true);
		$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
		$val = json_decode(json_encode($xmlstring),true);
		return $val;
	}
	
	/**
	 * 数组转换成xml格式
	 * @param array $data
	 * @return string
	 */
	public static function arraytoxml($data){
		$str='<xml>';
		foreach($data as $k=>$v) {
			$str.='<'.$k.'>'.$v.'</'.$k.'>';
		}
		$str.='</xml>';
		return $str;
	}
}

