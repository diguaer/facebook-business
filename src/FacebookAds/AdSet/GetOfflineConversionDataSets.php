<?php
namespace FacebookBusiness\FacebookAds\AdSet;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 获取线下事件转化集
 */
class GetOfflineConversionDataSets extends BaseParameters implements ApiInterface
{
	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		$params = [
			'access_token' => $this->accessToken
		];

		if ($this->limit > 0) {

			$params['limit'] = $this->limit;
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/offline_conversion_data_sets';
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
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}