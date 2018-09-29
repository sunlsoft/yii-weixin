<?php
$config = [
		'weixin' => [
				'class'=>'sunlsoft\yiiweixin',
		],
];
if (is_file(__DIR__ . '/config.local.php')) {
	include(__DIR__ . '/config.local.php');
}
return $config;