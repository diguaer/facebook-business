<?php

namespace FacebookBusiness\FacebookAds\Ad;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 查询广告系列下的广告
 */
class GetListByCampaign extends BaseParameters implements ApiInterface
{

	/**
	 * 广告系列id
	 * @var string
	 */
	public string $campaignId = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		$params = [
			'fields' => !empty($this->fields) ? $this->fields : 'name',
			'access_token' => $this->accessToken,
			'limit' => $this->getDefaultLimit()
		];

		$params = array_merge($params, $this->setDefaultListParamsByVerify());

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->campaignId . '/ads';
	}

	/**
	 * 请求方式
	 * @return string
	 */
	public function method(): string
	{
		return Constant::HTTP_GET;
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
			->setRequestJson(false)
			->execute();
	}


}