<?php

namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Enum\AdEnum;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 地理位置和语言搜索
 */
class Search extends BaseParameters implements ApiInterface
{

	/**
	 * 关键字
	 * @var string
	 */
	public string $q = '';

	/**
	 * 类型
	 * @var string
	 */
	public string $type = AdEnum::AUDIENCE_SEARCH_TYPE_ADGEOLOCATION;

	/**
	 * 国家地区，可选值：country、country_group、region、city、zip、geo_market
	 * @var string
	 */
	public string $locationTypes = '';

	/**
	 * 搜索国家代码
	 * @var bool
	 */
	public bool $matchCountryCode = false;

	/**
	 * 类别
	 * user_device：用户设备，user_os：用户设备系统
	 * @var string
	 */
	public string $class = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		$params = [
			'access_token' => $this->accessToken,
			'type' => $this->type,
			'limit' => $this->getDefaultLimit(),
			'place_fallback' => true
		];

		if ($this->q) {

			$params['q'] = $this->q;
		}

		if (!empty($this->locationTypes)) {

			$params['location_types'] = '["' . $this->locationTypes . '"]';
		}

		if ($this->matchCountryCode) {

			$params['match_country_code'] = $this->matchCountryCode;
		}

		if ($this->class) {

			$params['class'] = $this->class;
		}

		$params = array_merge($params, $this->setDefaultListParamsByVerify());

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/search';
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