<?php
namespace FacebookBusiness\FacebookAds;

interface ApiInterface {

	/**
	 * 设置参数
	 * @return mixed
	 */
	public function parameters(): mixed;

	/**
	 * 接口地址
	 * @return mixed
	 */
	public function apiPath(): mixed;

	/**
	 * 请求方式
	 * @return mixed
	 */
	public function method(): mixed;

	/**
	 * 发送数据
	 * @return mixed
	 */
	public function requestExecute(): mixed;


}