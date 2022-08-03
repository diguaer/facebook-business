<?php
namespace FacebookBusiness\FacebookAds\Ad;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 帖子详情
 */
class PostsDetail extends BaseParameters implements ApiInterface
{

	/**
	 * 广告id
	 * @var string
	 */
	public string $postsId = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		return new Parameters([
			'access_token' => $this->accessToken,
			'fields' => !empty($this->fields) ? $this->fields : '["actions","application","attachments{description,description_tags,media,media_type,subattachments,target,title,type,unshimmed_url,url}","call_to_action","comments.summary(true).limit(0)","coordinates","created_time","expanded_height","expanded_width","feed_targeting","from","full_picture","height","icon","id","instagram_eligibility","is_hidden","is_instagram_eligible","is_popular","is_published","is_spherical","likes.summary(true)","message_tags","message","parent_id","picture","place","privacy","promotable_id","promotion_status","properties","scheduled_publish_time","shares","status_type","story_tags","story","subscribed","targeting","timeline_visibility","to","updated_time","via","video_buying_eligibility","width","with_tags","sponsor_tags"]'
		]);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->postsId;
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
	 * @throws FBusinessException
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