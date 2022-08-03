<?php

namespace FacebookBusiness\FacebookAds\Ad;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 创建广告
 */
class Create extends BaseParameters implements ApiInterface
{

	/**
	 * 广告组id
	 * @var string
	 */
	public string $adSetId;

	/**
	 * 名称
	 * @var string
	 */
	public string $name;

	/**
	 * 追踪事件
	 * @var array|null
	 */
	public array|null $trackingSpecs;

	/**
	 * 广告创意
	 * @var array
	 */
	public array $creative;

	/**
	 * 广告的出价金额
	 * @var int
	 */
	public int $bidAmount;

	/**
	 * 网域追踪的域名
	 * @var string
	 */
	public string $conversionDomain;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
			'adset_id' => $this->adSetId,
			'name' => $this->name,
			'status' => $this->status,
			'tracking_specs' => $this->trackingSpecs,
			'creative' => $this->creative
		];

		if ($this->bidAmount > 0) {

			$params['bid_amount'] = $this->bidAmount;
		}

		if ($this->conversionDomain) {

			$params['conversion_domain'] = $this->conversionDomain;
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/ads';
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