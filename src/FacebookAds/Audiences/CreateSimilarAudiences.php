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
 * 创建类似受众
 */
class CreateSimilarAudiences extends BaseParameters implements ApiInterface
{

	/**
	 * 名称
	 * @var string
	 */
	public string $name;

	/**
	 * 详情参数
	 * @var array
	 */
	public array $lookalikeSpec;

	/**
	 * 类型，LOOKALIKE：类似受众
	 * @var string
	 */
	public string $subtype;

	/**
	 * 为自定义类似受众时，必传，自定义受众id
	 * @var string
	 */
	public string $originAudienceId;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
			'name' => $this->name,
			'subtype' => $this->subtype,
			'lookalike_spec' => $this->lookalikeSpec
		];

		if (!empty($this->originAudienceId)) {

			$params['origin_audience_id'] = $this->originAudienceId;
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/customaudiences';
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