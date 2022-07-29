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
 * 创建广告创意
 */
class CreateCreative extends BaseParameters implements ApiInterface
{

	/**
	 * 广告创意
	 * @var array
	 */
	public array $creative;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
		];

		foreach ($this->creative as $key => $value) {

			$params[$key] = $value;
		}

		unset($params['ad_creative_Id'], $params['ad_account_Id'], $params['deleted'], $params['created_at'], $params['updated_at'], $params['enable_direct_install']);

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/adcreatives';
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
			->setApiData($this->parameters()->export())
			->execute();
	}


}