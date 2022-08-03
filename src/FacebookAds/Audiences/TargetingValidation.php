<?php

namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Enum\AdEnum;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 兴趣，行为，人口统计元数据获取或校验
 */
class TargetingValidation extends BaseParameters implements ApiInterface
{

	/**
	 * 查询的数据列表
	 * $targetingList = [
	 *      [
	 *          'type' => '定位参数类型',
	 *          'id' => '定位参数id'
	 *      ],
	 * ......
	 * ]
	 * @var array
	 */
	public array $targetingList;

	/**
	 * 参数
	 * @return Parameters
	 * @throws BusinessException
	 */
	public function parameters(): Parameters
	{

		foreach ($this->targetingList as $item) {
			if (!empty($item['type']) || !in_array($item["type"], AdEnum::TARGETING_VALIDATION_TYPES, true)) {

				throw new BusinessException('资源类型异常', 90003);
			}
		}

		$params = [
			'access_token' => $this->accessToken,
			'type' => 'targetingvalidation',
			'targeting_list' => $this->targetingList
		];

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/targetingvalidation';
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
			->setLanguage($this->locale)
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}