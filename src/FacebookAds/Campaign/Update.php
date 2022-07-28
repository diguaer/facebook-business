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

class Update extends BaseParameters implements ApiInterface
{

	/**
	 * 广告系列id
	 * @var string
	 */
	public string $campaignId;

	/**
	 * 广告系列名称
	 * @var string
	 */
	public string $name;

	/**
	 * 目标
	 * @var string
	 */
	public string $objective;

	/**
	 * 购买类型
	 * @var string
	 */
	public string $buyingType;

	/**
	 * 广告系列花费限额
	 * @var int
	 */
	public int $spendCap;

	/**
	 * 广告系列预算单日预算
	 * @var int
	 */
	public int $dailyBudget;

	/**
	 * 广告系列预算总预算
	 * @var int
	 */
	public int $lifetimeBudget;

	/**
	 * 投放时段
	 * @var array
	 */
	public array $pacingType;

	/**
	 * 广告系列竞价策略
	 * @var string
	 */
	public string $bidStrategy;

	/**
	 * 特殊广告分类
	 * @var array
	 */
	public array $specialAdCategories = [];

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'name' => $this->name,
			'objective' => $this->objective,
			'status' => $this->status,
			'buying_type' => $this->buyingType,
			'access_token' => $this->accessToken,
			'spend_cap' => $this->spendCap,
			'daily_budget' => $this->dailyBudget,
			'lifetime_budget' => $this->lifetimeBudget,
			'pacing_type' => $this->pacingType,
			'bid_strategy' => $this->bidStrategy,
			'special_ad_categories' => $this->specialAdCategories
		];

		if ($this->spendCap <= 0) {

			$params['spend_cap'] = null;
		}

		if ($this->dailyBudget <= 0) {

			$params['daily_budget'] = null;
		}

		if ($this->lifetimeBudget <= 0) {

			$params['lifetime_budget'] = null;
		}

		if (empty($this->pacingType)) {

			$params['pacing_type'] = null;
		}

		if (empty($this->bidStrategy)) {

			$params['bid_strategy'] = null;
		}

		return new Parameters($params);
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
		return Constant::HTTP_POST;
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