<?php
namespace FacebookBusiness\FacebookAds\Enum;

class AdEnum {

	/**
	 * 受众
	 */
	public const CATEGORY_SELECT_AUDIENCE = 'audience';

	/**
	 * 广告系列
	 */
	public const CATEGORY_SELECT_CAMPAIGN = 'campaign';

	/**
	 * 广告组
	 */
	public const CATEGORY_SELECT_ADSET = 'adset';

	/**
	 * 广告
	 */
	public const CATEGORY_SELECT_AD = 'ad';

	/**
	 * 默认查询的字段
	 */
	public const DEFAULT_CATEGORY_SELECT_FILED = [
		self::CATEGORY_SELECT_AUDIENCE => 'id,name,subtype,operation_status,data_source,delivery_status,description,rule,lookalike_spec,regulated_audience_spec,updated_time,created_time',
		self::CATEGORY_SELECT_CAMPAIGN => 'id,name,spend_cap,can_use_spend_cap,buying_type,status,effective_status,objective,daily_budget,lifetime_budget,source_campaign_id,bid_strategy,pacing_type,updated_time,created_time',
		self::CATEGORY_SELECT_ADSET => 'id,campaign_id,name,destination_type,promoted_object,daily_budget,lifetime_budget,start_time,end_time,pacing_type,adset_schedule,targeting,optimization_goal,bid_amount,bid_strategy,billing_event,status,effective_status,source_adset_id,updated_time,created_time',
		self::CATEGORY_SELECT_AD => 'id,campaign_id,adset_id,name,bid_amount,conversion_domain,creative,effective_status,status,tracking_specs,source_ad_id,updated_time,created_time',
	];

	/**
	 * 动态创意开
	 */
	public const DYNAMIC_CREATIVE_OPEN = 1;

	/**
	 * 动态创意关
	 */
	public const DYNAMIC_CREATIVE_CLOSE = 0;


}