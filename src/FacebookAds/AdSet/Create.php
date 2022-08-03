<?php

namespace FacebookBusiness\FacebookAds\AdSet;

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
 * 创建广告组
 */
class Create extends BaseParameters implements ApiInterface
{

	/**
	 * 广告系列id
	 * @var string
	 */
	public string $campaignId;

	/**
	 * 名称
	 * @var string
	 */
	public string $name;

	/**
	 * 广告投放优化目标
	 * @var string
	 */
	public string $optimizationGoal;

	/**
	 * 费用控制额
	 * @var int
	 */
	public int $bidAmount;

	/**
	 * 投放时段
	 * @var array
	 */
	public array $pacingType;

	/**
	 * 单日预算
	 * @var int
	 */
	public int $dailyBudget;

	/**
	 * 总预算
	 * @var int
	 */
	public int $lifetimeBudget;

	/**
	 * 排期开始时间
	 * @var string
	 */
	public string $startTime;

	/**
	 * 排期结束时间
	 * @var string
	 */
	public string $endTime;

	/**
	 * 转化目标
	 * @var array
	 */
	public array $promotedObject;

	/**
	 * 广告组使用的计费事件
	 * @var string
	 */
	public string $billingEvent;

	/**
	 * 受众信息
	 * @var array
	 */
	public array $targeting;

	/**
	 * 分时段投放
	 * @var array
	 */
	public array $adSetSchedule;

	/**
	 * 竞价策略
	 * @var string
	 */
	public string $bidStrategy;

	/**
	 * 动态创意开关，1：开，0：关
	 * @var int
	 */
	public int $isDynamicCreative = AdEnum::DYNAMIC_CREATIVE_CLOSE;

	/**
	 * 格式化广告组参数
	 * @param string $accessToken
	 * @param string $campaignId
	 * @param string $name
	 * @param string $optimizationGoal
	 * @param int $bidAmount
	 * @param array $pacingType
	 * @param int $dailyBudget
	 * @param int $lifetimeBudget
	 * @param string $startTime
	 * @param string $endTime
	 * @param array $promotedObject
	 * @param string $billingEvent
	 * @param array $targeting
	 * @param array $adSetSchedule
	 * @param string $bidStrategy
	 * @param int $isDynamicCreative
	 * @param string $status
	 * @return array
	 */
	protected function adSetsParamsFormat(
		string $accessToken,
		string $campaignId,
		string $name,
		string $optimizationGoal,
		int    $bidAmount,
		array  $pacingType,
		int    $dailyBudget,
		int    $lifetimeBudget,
		string $startTime,
		string $endTime,
		array  $promotedObject,
		string $billingEvent,
		array  $targeting,
		array  $adSetSchedule,
		string $bidStrategy,
		int    $isDynamicCreative,
		string $status = ''
	): array
	{
		$params = [
			'access_token' => $accessToken,
			'name' => $name,
			'campaign_id' => $campaignId,
			'optimization_goal' => $optimizationGoal,
			'status' => $status,
			'targeting' => $targeting
		];

		if (!empty($startTime)) {

			$params['start_time'] = $startTime;
		}

		if (!empty($billingEvent)) {

			$params['billing_event'] = $billingEvent;
		}

		if (!empty($endTime)) {

			$params['end_time'] = $endTime;
		} else {

			$params['end_time'] = null;
		}

		if (!empty($pacingType)) {

			$params['pacing_type'] = $pacingType;
		}

		if (!empty($adSetSchedule)) {

			$params['adset_schedule'] = $adSetSchedule;
		}

		if ($bidAmount > 0) {

			$params['bid_amount'] = $bidAmount;
		} else {

			$params['bid_amount'] = null;
		}

		if ($dailyBudget > 0) {

			$params['daily_budget'] = $dailyBudget;
		} else {

			$params['daily_budget'] = null;
		}

		if ($lifetimeBudget > 0) {

			$params['lifetime_budget'] = $lifetimeBudget;
		} else {
			$params['lifetime_budget'] = null;
		}

		if (!empty($promotedObject)) {

			$params['promoted_object'] = $promotedObject;
		}

		if (!empty($status)) {

			$params['status'] = $status;
		}

		if (empty($bidStrategy)) {

			$params['bid_strategy'] = null;
		} else {

			$params['bid_strategy'] = $bidStrategy;
		}

		if (AdEnum::DYNAMIC_CREATIVE_OPEN === $isDynamicCreative) {

			$params['is_dynamic_creative'] = true;
		} else {

			$params['is_dynamic_creative'] = false;
		}

		return $params;
	}

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = $this->adSetsParamsFormat(
			$this->accessToken,
			$this->campaignId,
			$this->name,
			$this->optimizationGoal,
			$this->bidAmount,
			$this->pacingType,
			$this->dailyBudget,
			$this->lifetimeBudget,
			$this->startTime,
			$this->endTime,
			$this->promotedObject,
			$this->billingEvent,
			$this->targeting,
			$this->adSetSchedule,
			$this->bidStrategy,
			$this->isDynamicCreative,
			$this->status
		);

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/adsets';
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
			->setLanguage($this->locale)
			->setApiData($this->parameters()->export())
			->execute();
	}


}