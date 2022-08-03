<?php
namespace FacebookBusiness\FacebookAds\Common;

use FacebookBusiness\ApiConfig;
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
 * 批量查询详情 广告系列/广告组/广告/受众
 */
class BatchDetail  extends BaseParameters implements ApiInterface {

	/**
	 * 要查询的id，广告系列id/广告组id/广告id/受众id
	 * @var array
	 */
	public array $ids;

	/**
	 * 要查询的类型，系列/组/广告/受众
	 * @var string
	 */
	public string $selectType = AdEnum::CATEGORY_SELECT_CAMPAIGN;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		if (empty($this->fields)) {

			$this->fields = AdEnum::DEFAULT_CATEGORY_SELECT_FILED[$this->selectType];
		}

		$batch = [];
		foreach ($this->ids as $id) {

			$batch[] = $batch[] = [
				'method' => Constant::HTTP_GET,
				'relative_url' => '/' . ApiConfig::getInstance()->baseConfig()['fb_api_version'] . '/' . $id .'?fields=' . $this->fields
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