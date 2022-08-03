<?php

namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 修改类似受众
 */
class UpdateSimilarAudiences extends BaseParameters implements ApiInterface
{

	/**
	 * 名称
	 * @var string
	 */
	public string $name;

	/**
	 * 受众id
	 * @var string
	 */
	public string $audienceId;

	/**
	 * 描述
	 * @var string
	 */
	public string $description;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
			'name' => $this->name,
			'description' => $this->description
		];

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->audienceId;
	}

	/**
	 * 请求方式
	 * @return string
	 */
	public function method(): string
	{
		return Constant::HTTP_POST;
	}

	/**
	 * 获取数据
	 * @throws BusinessException
	 * @throws JsonException|GuzzleException
	 */
	public function requestExecute(): mixed
	{
		$request = new Request();
		return $request->setMethod($this->method())
			->setUrl($this->apiPath())
			->setLanguage($this->locale)
			->setApiData($this->parameters()->export())
			->execute();
	}


}