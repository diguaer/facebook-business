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
 * 细分定位搜索
 */
class TargetingSearch extends BaseParameters implements ApiInterface
{

	/**
	 * 关键字
	 * @var string
	 */
	public string $q = '';

	/**
	 * 是否排除，false：否，true：是
	 * @var bool
	 */
	public bool $isExclusion = false;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		if (empty($this->fields)) {

			$this->fields = '["raw_name","id","name","type","path","audience_size_lower_bound","audience_size_upper_bound","description","valid","source","partner","performance_rating","spend","conversion_lift","is_recommendation","recommendation_model","search_interest_id"]';
		}

		$params = [
			'access_token' => $this->accessToken,
			'q' => $this->q,
			'limit' => $this->getDefaultLimit(),
			'fields' => $this->fields,
			'is_exclusion' => $this->isExclusion
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
		return '/' . $this->adAccountId . '/targetingsearch';
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
			->setRequestJson(false)
			->execute();
	}


}