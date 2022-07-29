<?php

namespace FacebookBusiness\FacebookAds\Ad;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 获取个人主页帖子列表（只能获取已发布的帖子）
 */
class GetPostsList extends BaseParameters implements ApiInterface
{

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		if (0 === $this->limit) {

			$this->limit = 100;
		}

		$params = [
			'fields' => !empty($this->fields) ? $this->fields : '["actions","application","attachments{description,description_tags,media,media_type,subattachments,target,title,type,unshimmed_url,url}","call_to_action","comments.summary(true).limit(0)","coordinates","created_time","expanded_height","expanded_width","feed_targeting","from","full_picture","height","icon","id","instagram_eligibility","is_hidden","is_instagram_eligible","is_popular","is_published","is_spherical","likes.summary(true)","message_tags","message","parent_id","picture","place","privacy","promotable_id","promotion_status","properties","scheduled_publish_time","shares","status_type","story_tags","story","subscribed","targeting","timeline_visibility","to","updated_time","via","video_buying_eligibility","width","with_tags","sponsor_tags"]',
			'access_token' => $this->accessToken,
			'limit' => $this->limit
		];

		$params = array_merge($params, $this->setDefaultListParamsByVerify());

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->pageId . '/feed';
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
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}