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
 * 广告组获取预估受众信息
 */
class GetEstimateAudiences extends BaseParameters implements ApiInterface
{

	/**
	 * 目标规格
	 * @var string
	 */
	public string $targetingSpec;

	/**
	 * 优化目标
	 * @var string
	 */
	public string $optimizationGoal;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		return new Parameters([
			'ad_account_Id' => $this->adAccountId,
			'access_token' => $this->accessToken,
			'targeting_spec' => $this->targetingSpec,
			'optimization_goal' => $this->optimizationGoal
		]);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/delivery_estimate';
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