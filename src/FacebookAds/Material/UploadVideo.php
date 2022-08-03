<?php

namespace FacebookBusiness\FacebookAds\Material;

use CURLFile;
use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 上传视频素材
 */
class UploadVideo extends BaseParameters implements ApiInterface
{
	/**
	 * 视频文件对象
	 * @var CURLFile
	 */
	public CURLFile $source;

	/**
	 * 视频缩略图
	 * @var CURLFile|null
	 */
	public CURLFile|null $thumb = null;

	/**
	 * 视频名称
	 * @var string
	 */
	public string $title;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'title' => $this->title,
			'access_token' => $this->accessToken,
			'source' => $this->source
		];

		if ($this->thumb !== null) {

			$params['thumb'] = $this->thumb;
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/advideos';
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
	 * @throws FBusinessException
	 * @throws JsonException|GuzzleException
	 */
	public function requestExecute(): mixed
	{
		$request = new Request();
		return $request->setMethod($this->method())
			->setIsFile(true)
			->setUrl($this->apiPath())
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}