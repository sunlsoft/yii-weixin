<?php
namespace  sunlsoftunit\extensions\weixin;

use yii\di\Container;
use yii\helpers\ArrayHelper;
use Yii;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
	
	public static $params;
	
	/**
	 * Returns a test configuration param from /data/config.php
	 * @param  string $name params name
	 * @param  mixed $default default value to use when param is not set.
	 * @return mixed  the value of the configuration param
	 */
	public static function getParam($name, $default = null)
	{
		if (static::$params === null) {
			static::$params = require(__DIR__ . '/data/config.php');
		}
		return isset(static::$params[$name]) ? static::$params[$name] : $default;
	}
	
	public static function getWeixinObj(){
		return \Yii::createObject(self::getParam('weixin'));
	}
	
	
	/**
	 * Clean up after test.
	 * By default the application created with [[mockApplication]] will be destroyed.
	 */
	protected function tearDown()
	{
		parent::tearDown();
		$this->destroyApplication();
	}
	
	
	/**
	 * Populates Yii::$app with a new application
	 * The application will be destroyed on tearDown() automatically.
	 * @param array $config The application configuration, if needed
	 * @param string $appClass name of the application class to create
	 */
	protected function mockApplication($config = [], $appClass = '\yii\console\Application')
	{
		new $appClass(ArrayHelper::merge([
				'id' => 'testapp',
				'basePath' => __DIR__,
				'vendorPath' => dirname(__DIR__) . '/vendor',
		], $config));
	}
	
	protected function mockWebApplication($config = [], $appClass = '\yii\web\Application')
	{
		new $appClass(ArrayHelper::merge([
				'id' => 'testapp',
				'basePath' => __DIR__,
				'vendorPath' => dirname(__DIR__) . '/vendor',
				'components' => [
						'request' => [
								'cookieValidationKey' => 'wefJDF8sfdsfSDefwqdxj9oq',
								'scriptFile' => __DIR__ .'/index.php',
								'scriptUrl' => '/index.php',
						],
				]
		], $config));
	}
	
	/**
	 * Destroys application in Yii::$app by setting it to null.
	 */
	protected function destroyApplication()
	{
		Yii::$app = null;
		Yii::$container = new Container();
	}
	
	/**
	 * Asserting two strings equality ignoring line endings
	 *
	 * @param string $expected
	 * @param string $actual
	 */
	public function assertEqualsWithoutLE($expected, $actual)
	{
		$expected = str_replace(["\r", "\n"], '', $expected);
		$actual = str_replace(["\r", "\n"], '', $actual);
		$this->assertEquals($expected, $actual);
	}
	
	/**
	 * Invokes object method, even if it is private or protected.
	 * @param object $object object.
	 * @param string $method method name.
	 * @param array $args method arguments
	 * @return mixed method result
	 */
	protected function invoke($object, $method, array $args = [])
	{
		$classReflection = new \ReflectionClass(get_class($object));
		$methodReflection = $classReflection->getMethod($method);
		$methodReflection->setAccessible(true);
		$result = $methodReflection->invokeArgs($object, $args);
		$methodReflection->setAccessible(false);
		return $result;
	}
	
}

