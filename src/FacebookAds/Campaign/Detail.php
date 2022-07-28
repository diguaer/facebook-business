<?php
namespace FacebookBusiness\FacebookAds\Campaign;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 广告系列详情
 */
class Detail extends BaseParameters implements ApiInterface
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
		return new Parameters([
			'access_token' => $this->accessToken,
			'fields' => !empty($this->fields) ? $this->fields : 'name,account_id,objective,status,spend_cap,pacing_type,daily_budget,lifetime_budget,buying_type,special_ad_categories'
		]);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->campaignId;
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
			->execute();
	}


}