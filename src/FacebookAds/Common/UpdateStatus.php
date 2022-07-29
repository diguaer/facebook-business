<?php
namespace FacebookBusiness\FacebookAds\Common;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 更新状态 广告系列/广告组/广告/受众
 */
class UpdateStatus  extends BaseParameters implements ApiInterface {

	/**
	 * 要更新的id，广告系列id/广告组id/广告id/受众id
	 * @var string
	 */
	public string $id;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		return new Parameters([
			'access_token' => $this->accessToken,
			'status' => $this->status
		]);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->id;
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
	 * 删除数据
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