<?php

namespace FacebookBusiness\Http;


interface RequestInterface
{
	/**
	 * 设置接口请求地址
	 * @param string $url
	 * @return mixed
	 */
	public function setUrl(string $url): mixed;

	/**
	 * 获取接口地址
	 * @return string
	 */
	public function getUrl(): string;

	/**
	 * 设置接口请求参数
	 * @param array $data
	 * @return mixed
	 */
	public function setApiData(array $data): mixed;

	/**
	 * 获取接口请求参数
	 * @return array
	 */
	public function getApiData(): array;

	/**
	 * 设置请求方式
	 * @param string $method
	 * @return mixed
	 */
	public function setMethod(string $method): mixed;

	/**
	 * 获取请求方式
	 * @return string
	 */
	public function getMethod(): string;

	/**
	 * 设置请求头
	 * @param Headers $header
	 * @return mixed
	 */
	public function setHeader(Headers $header): mixed;

	/**
	 * 获取请求头
	 * @return Headers
	 */
	public function getHeader(): Headers;

	/**
	 * 设置发送数据是否为json
	 * @param bool $bool
	 * @return mixed
	 */
	public function setRequestJson(bool $bool): mixed;

	/**
	 * 发送数据是否为json
	 * @return bool
	 */
	public function getRequestJson(): bool;

	/**
	 * 是否发送文件
	 * @return bool
	 */
	public function getIsFile():bool;

	/**
	 * 是否发送文件
	 * @param bool $isFile
	 * @return $this
	 */
	public function setIsFile(bool $isFile): mixed;

	/**
	 * 设置语言
	 * @param string $language
	 * @return $this
	 */
	public function setLanguage(string $language): mixed;

	/**
	 * 获取语言
	 * @return string
	 */
	public function getLanguage(): string;

	/**
	 * curl请求
	 * @param string $funcName
	 * @param bool $isException
	 * @param $error
	 * @return mixed
	 */
	public function execute(string $funcName, bool $isException, &$error): mixed;

}
