<?php
namespace sunlsoft\yiiweixin\base;

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
	public static function arraytoxml($arr){
		$xml = "<xml>";
		$xml .=self::arraytoxmlStr($arr);
		$xml.="</xml>";		

		return $xml;
	}
	
	
	/**
	 * 数组转换成xml格式
	 * @param array $data
	 * @return string
	 */
	public static function arraytoxmlStr($arr){
		$xml = '';
		foreach ($arr as $key => $val){
			if (is_numeric($val)){
				$xml.="<".$key.">".$val."</".$key.">";
			}elseif (is_string($val)){
				$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
			}elseif (is_array($val)){
				$xml .= (is_numeric($key)) ?  self::arraytoxmlStr($val) : "<".$key.">". self::arraytoxmlStr($val)."</".$key.">";
			}
		}
		
		return $xml; 
	}
}

