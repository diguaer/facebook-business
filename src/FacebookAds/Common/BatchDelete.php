<?php
namespace FacebookBusiness\FacebookAds\Common;

use FacebookBusiness\ApiConfig;
use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 批量删除 广告系列/广告组/广告/受众
 */
class BatchDelete  extends BaseParameters implements ApiInterface {

	/**
	 * 要删除的id，广告系列id/广告组id/广告id/受众id
	 * @var array
	 */
	public array $ids;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		$batch = [];
		foreach ($this->ids as $id) {

			$batch[] = [
				'method' => Constant::HTTP_DELETE,
				'relative_url' => '/' . ApiConfig::getInstance()->baseConfig()['fb_api_version'] . '/' . $id
			];

		}

		return new Parameters([
			'access_token' => $this->accessToken,
			'batch' => $batch
		]);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '';
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
	 * @throws FBusinessException
	 * @throws JsonException|GuzzleException
	 */
	public function requestExecute(): mixed
	{
		$request = new Request();
		return $request->setMethod($this->method())
			->setBaseUrl()
			->setLanguage($this->locale)
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}