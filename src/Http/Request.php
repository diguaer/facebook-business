<?php

namespace FacebookBusiness\Http;


use FacebookBusiness\ApiConfig;
use FacebookBusiness\ErrorCode\ErrorCodes;
use FacebookBusiness\Exception\BusinessException;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Request implements RequestInterface
{
	use ErrorCodes;

	/**
	 * 配置
	 * @var array $config
	 */
	public array $config;

	/**
	 * @var string http请求方式
	 */
	public string $method = Constant::HTTP_GET;

	/**
	 * @var Headers 请求头
	 */
	public Headers $header;

	/**
	 * @var bool 是否发送json格式
	 * true：是
	 * false：否
	 */
	public bool $requestJson = true;

	/**
	 * @var bool 是否发送文件
	 * true：是
	 * false：否
	 */
	public bool $isFile = false;

	/**
	 * @var string 接口语言
	 */
	public string $language = Constant::LANGUAGE_ZH_CN;

	/**
	 * 接口地址
	 * @var string
	 */
	private string $url = '';

	/**
	 * 接口参数
	 * @var array $apiData
	 */
	private array $apiData = [];


	public function __construct(array $config = [])
	{
		if (empty($config)) {
			$this->config = ApiConfig::getInstance()->baseConfig();
		} else {

			$this->config = $config;
		}

		$this->header = new Headers([]);

	}

	/**
	 * 设置配置
	 * @param array $config
	 * @return $this
	 */
	public function setConfig(array $config = []): Request
	{
		if (!empty($config)) {
			$this->config = $config;
		}

		return $this;
	}

	/**
	 * 获取配置
	 * @return array
	 */
	public function getConfig(): array
	{
		return $this->config;
	}

	/**
	 * 设置接口地址
	 * @param string $path
	 * @return $this
	 */
	public function setUrl(string $path): Request
	{
		$this->url = $this->config['fb_api_host'] . '/' . $this->config['fb_api_version'] . $path;
		return $this;
	}

	/**
	 * 获取接口地址
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}

	/**
	 * 设置接口参数
	 * @param array $data
	 * @return $this
	 */
	public function setApiData(array $data): Request
	{
		$this->apiData = $data;
		return $this;
	}

	/**
	 * 获取接口参数
	 * @return array
	 */
	public function getApiData(): array
	{
		return $this->apiData;
	}

	/**
	 * POST请求
	 * @return $this
	 */
	public function methodPost(): Request
	{
		$this->method = Constant::HTTP_POST;
		return $this;
	}

	/**
	 * GET请求
	 * @return $this
	 */
	public function methodGet(): Request
	{
		$this->method = Constant::HTTP_GET;
		return $this;
	}

	/**
	 * 删除请求
	 * @return $this
	 */
	public function methodDelete(): Request
	{
		$this->method = Constant::HTTP_DELETE;
		return $this;
	}

	/**
	 * PUT请求
	 * @return $this
	 */
	public function methodPut(): Request
	{
		$this->method = Constant::HTTP_PUT;
		return $this;
	}

	/**
	 * HEAD请求
	 * @return $this
	 */
	public function methodHead(): Request
	{
		$this->method = Constant::HTTP_HEAD;
		return $this;
	}

	/**
	 * 设置请求方式
	 * @param string $method
	 * @return $this
	 */
	public function setMethod(string $method): Request
	{
		$this->method = $method;
		return $this;
	}

	/**
	 * 获取请求方式
	 * @return string
	 */
	public function getMethod(): string
	{
		return $this->method;
	}

	/**
	 * 设置请求头
	 * @param Headers $header
	 * @return $this
	 */
	public function setHeader(Headers $header): Request
	{
		$this->header = $header;
		return $this;
	}

	/**
	 * 获取请求头
	 * @return Headers
	 */
	public function getHeader(): Headers
	{
		return $this->header;
	}

	/**
	 * 设置发送数据是否为json
	 * @param bool $bool
	 * @return $this
	 */
	public function setRequestJson(bool $bool): Request
	{
		$this->requestJson = $bool;
		return $this;
	}

	/**
	 * 发送数据是否为json
	 * @return bool
	 */
	public function getRequestJson(): bool
	{
		return $this->requestJson;
	}

	/**
	 * 是否发送文件
	 * @return bool
	 */
	public function getIsFile(): bool
	{
		return $this->isFile;
	}

	/**
	 * 是否发送文件
	 * @param bool $isFile
	 * @return $this
	 */
	public function setIsFile(bool $isFile): Request
	{
		$this->isFile = $isFile;
		return $this;
	}

	/**
	 * 设置语言
	 * @param string $language
	 * @return $this
	 */
	public function setLanguage(string $language): Request
	{
		$this->language = $language;
		return $this;
	}

	/**
	 * 获取语言
	 * @return string
	 */
	public function getLanguage(): string
	{
		return $this->language;
	}

	/**
	 * 设置语言为英语
	 * @return $this
	 */
	public function setLanguageEnUS(): Request
	{
		$this->language = Constant::LANGUAGE_EN_US;
		return $this;
	}

	/**
	 * 设置语言为中文
	 * @return $this
	 */
	public function setLanguageZhCN(): Request
	{
		$this->language = Constant::LANGUAGE_ZH_CN;
		return $this;
	}

	/**
	 * 执行curl请求
	 * @param string $funcName
	 * @param $isException  true:抛异常  false:不抛异常
	 * @param null $error
	 * @return mixed
	 * @throws BusinessException
	 * @throws JsonException
	 * @throws GuzzleException
	 */
	public function execute(string $funcName = '', $isException = true, &$error = null): mixed
	{

		if (!empty($error)) {

			if ($isException) {
				throw new BusinessException($error, 21);
			}

			return false;
		}

		if (!isset($this->apiData['locale'])) {

			$this->apiData['locale'] = $this->language;
		}

		$client = new Client();
		if ($this->isFile) {

			$result = $client->sendFile($this->url, $this->apiData, $this->requestJson);
		} else {

			$result = $client->execute($this->url, $this->apiData, $this->method, $this->header->export(), $this->requestJson);
		}

		if (!$result) {

			throw new BusinessException('接口请求错误', 500);
		}

		if ($isException) {

			try {

				if (isset($result['error'])) {

					$error = $result['error'];

					if (isset($result['error']['error_user_msg'])) {

						$errorMsg = $result['error']['error_user_msg'];
					} elseif (isset($result['error']['error_user_title'])) {

						$errorMsg = $result['error']['error_user_title'];
					} else {

						$errorMsg = $result['error']['message'];
					}

					throw new BusinessException($errorMsg, $result['error']['code'] ?? 500);
				}

				return $result;

			} catch (\Exception $e) {

				$errorCode = $result['error']['code'] ?? 5000;

				$errorSubCode = $result['error']['error_subcode'] ?? 0;

				if (isset($result['error']['error_user_msg']) && !empty($result['error']['error_user_msg'])) {

					$message = $result['error']['error_user_msg'];
				} else {

					$message = $result['error']['message'];
				}

				if ($errorSubCode <= 0) {

					$code = (int)$errorCode === 200 ? 500 : $errorCode;
				} else {

					$code = (int)$errorSubCode === 200 ? 500 : $errorSubCode;
				}
				throw new BusinessException($this->getErrorMessage((int)$errorCode, (int)$errorSubCode, $message), $code);
			}
		} else {

			if (isset($result['error'])) {

				$error = $result['error'];
			}

			return $result;
		}


	}

}
