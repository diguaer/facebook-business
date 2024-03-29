<?php
namespace FacebookBusiness\FacebookAds\AdSet;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 广告组详情
 */
class Detail extends BaseParameters implements ApiInterface
{

	/**
	 * 广告组id
	 * @var string
	 */
	public string $adSetId = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		return new Parameters([
			'access_token' => $this->accessToken,
			'fields' => !empty($this->fields) ? $this->fields : 'name,targeting'
		]);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adSetId;
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