<?php

namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 修改自定义受众
 */
class UpdateCustomAudiences extends BaseParameters implements ApiInterface
{
	/**
	 * 受众id
	 * @var string
	 */
	public string $audienceId;

	/**
	 * 名称
	 * @var string
	 */
	public string $name;

	/**
	 * 规则
	 * @var array
	 */
	public array $rule;

	/**
	 * true：包括创建受众前记录的网站活动 false：仅包含创建受众后的网站流量
	 * @var bool
	 */
	public bool $prefill;

	/**
	 * 说明
	 * @var int
	 */
	public int $description;

	/**
	 * 转化率 1--180
	 * @var int
	 */
	public int $retentionDays;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
			'name' => $this->name,
			'rule' => $this->rule,
			'prefill' => $this->prefill,
			'description' => $this->description
		];

		if ($this->retentionDays > 0) {

			$params['retention_days'] = (string)$this->retentionDays;
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->audienceId;
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