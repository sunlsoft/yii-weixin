<?php
$config = [
		'weixin' => [
				'class'=>'sunlsoft\yiiweixin\weixin',
				'appid'=>'wxb11529c136998cb6',
				'EncodingAESKey'=>'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG',
				'Token'=>'pamtest'
		],
];
if (is_file(__DIR__ . '/config.local.php')) {
	include(__DIR__ . '/config.local.php');
}
return $config;