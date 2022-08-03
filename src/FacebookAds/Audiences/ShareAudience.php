<?php

namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 分享受众
 */
class ShareAudience extends BaseParameters implements ApiInterface
{

	/**
	 * 受众id
	 * @var string
	 */
	public string $audienceId = '';

	/**
	 * 分享的广告账号id ["610131523336893", "610131523336893", ……]
	 * @var array
	 */
	public array $adAccounts;

	/**
	 * 类型
	 * @var string
	 */
	public string $relationshipType = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		$params = [
			'access_token' => $this->accessToken,
			'adaccounts' => $this->adAccounts
		];

		if (empty($this->relationshipType)) {

			$params['relationship_type'] = '["Information Manager"]';
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->audienceId .'/adaccounts';
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
	 * @throws FBusinessException
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