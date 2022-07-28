<?php
namespace FacebookBusiness;

trait Instance {

	//创建静态私有的变量保存该类对象
	static private $instance;

	//防止使用new直接创建对象
	private function __construct(){}

	//防止使用clone克隆对象
	private function __clone(){}

	static public function getInstance()
	{
		//判断$instance是否是Singleton的对象，不是则创建
		if (!self::$instance instanceof self) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
