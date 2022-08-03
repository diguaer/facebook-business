<?php

namespace FacebookBusiness\FacebookAds;

use FacebookBusiness\FacebookAds\Enum\AdEnum;

class BaseParameters
{

	/**
	 * 用户token
	 * @var string
	 */
	public string $accessToken = '';

	/**
	 * 广告账号
	 * @var string
	 */
	public string $adAccountId = '';

	/**
	 * 主页id
	 * @var string
	 */
	public string $pageId = '';

	/**
	 * 状态
	 * @var string
	 */
	public string $status;

	/**
	 * 主页token
	 * @var string
	 */
	public string $pageToken = '';

	/**
	 * 查询字段
	 * @var string
	 */
	public string $fields = '';

	/**
	 * 筛选条件
	 * @var array
	 */
	public array $filtering = [];

	/**
	 * 关键字
	 * @var string
	 */
	public string $keyword = '';

	/**
	 * 分页条数
	 * @var int
	 */
	public int $limit = 0;

	/**
	 * 上一页
	 * @var string
	 */
	public string $before = '';

	/**
	 * 下一页
	 * @var string
	 */
	public string $after = '';

	/**
	 * 语言
	 * @var string
	 */
	public string $locale = AdEnum::LANGUAGE_ZH_CN;

	/**
	 * 获取默认分页条数
	 * @return int
	 */
	public function getDefaultLimit(): int
	{
		if (0 >= $this->limit) {

			$this->limit = 100;
		}

		return $this->limit;
	}

	/**
	 * 验证并设置列表默认参数
	 * @return array
	 */
	public function setDefaultListParamsByVerify(): array
	{
		$params = [];

		if (!empty($this->before)) {

			$params['before'] = $this->before;
		}

		if (!empty($this->after)) {

			$params['after'] = $this->after;
		}

		if (!empty($this->keyword)) {

			$params['filtering'] = [["field" => "name", "operator" => "CONTAIN", "value" => $this->keyword]];
		}

		if (!empty($this->filtering)) {

			$params['filtering'] = array_merge($this->filtering, $params['filtering'] ?? []);
		}

		return $params;
	}

}