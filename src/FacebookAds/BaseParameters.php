<?php

namespace FacebookBusiness\FacebookAds;

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
	public int $limit = 500;

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

}