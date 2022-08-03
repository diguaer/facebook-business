<?php

namespace FacebookBusiness\FacebookAds\Enum;

class AdEnum
{

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

	/**
	 * 按国家/地区、国家/地区组、城市、州份、邮政编码及其他地理区域搜索目标
	 */
	public const AUDIENCE_SEARCH_TYPE_ADGEOLOCATION = 'adgeolocation';

	/**
	 * 语言-中文
	 */
	public const LANGUAGE_ZH_CN = 'zh_CN';

	/**
	 * 语言-英文
	 */
	public const LANGUAGE_EN_US = 'en_US';

	/**
	 * 地理位置源数据的数据源key值
	 */
	public const Ad_GEO_LOCATION_META_KEYS = [
		'countries' => 'countries',
		'regions' => 'regions',
		'cities' => 'cities',
		'zips' => 'zips',
		'places' => 'places',
		'custom_locations' => 'custom_locations',
		'geo_markets' => 'geo_markets',
		'electoral_districts' => 'electoral_districts',
		'country_groups' => 'country_groups',
		'subneighborhoods' => 'subneighborhoods',
		'neighborhoods' => 'neighborhoods',
		'subcities' => 'subcities',
		'metro_areas' => 'metro_areas',
		'small_geo_areas' => 'small_geo_areas',
		'medium_geo_areas' => 'medium_geo_areas',
		'large_geo_areas' => 'large_geo_areas',
		'location_cluster_ids' => 'location_cluster_ids'
	];

	/**
	 * 兴趣，行为，人口统计等数据源类型
	 */
	public const TARGETING_VALIDATION_TYPES = [
		"interests",
		"education_statuses",
		"education_schools",
		"education_majors",
		"work_positions",
		"work_employers",
		"interested_in",
		"relationship_statuses",
		"college_years",
		"family_statuses",
		"industries",
		"life_events",
		"political_views",
		"politics",
		"behaviors",
		"income",
		"net_worth",
		"home_type",
		"home_ownership",
		"home_value",
		"ethnic_affinity",
		"generation",
		"household_composition",
		"moms",
		"office_type",
		"user_adclusters",
	];

}