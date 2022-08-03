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
 * 地址位置源数据详情搜索
 */
class GeoLocationMetaSearch extends BaseParameters implements ApiInterface
{

	/**
	 * 搜索条件，[{"countries":["US","JP"]},{"cities":[2418779]},......]
	 * @var array
	 */
	public array $search;

	/**
	 * 参数
	 * @return Parameters
	 * @throws FBusinessException
	 */
	public function parameters(): Parameters
	{
		$params = [
			'access_token' => $this->accessToken,
			'type' => 'adgeolocationmeta',
			'limit' => $this->getDefaultLimit(),
			'place_fallback' => true
		];

		if (!empty($this->search)) {

			foreach ($this->search as $types) {

				foreach ($types as $key => $value) {

					if (!array_key_exists($key, AdEnum::Ad_GEO_LOCATION_META_KEYS)) {

						throw new FBusinessException('参数错误', 90001);
					}

					if (!is_array($value)) {

						throw new FBusinessException('参数值必须为数组', 90002);
					}

					$params[$key] = $value;
				}

			}
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