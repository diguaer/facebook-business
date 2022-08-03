<?php

namespace FacebookBusiness\FacebookAds\Material;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 上传图片素材
 */
class UploadImage extends BaseParameters implements ApiInterface
{
	/**
	 * 图片字节流
	 * $bytes = imgUrlToBase64($bytes)
	 * @var string
	 */
	public string $bytes;

	/**
	 * 图片名称
	 * @var string
	 */
	public string $name;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'bytes' => $this->bytes,
			'access_token' => $this->accessToken,
			'endpoint' => '/' . $this->adAccountId . '/adimages',
			//'encoding' => 'data:image/jpeg;base64',
			//'height' => 500,
			//'width' => 500
		];

		if (!empty($this->name)) {

			$params['name'] = $this->name;
		}

		if (!empty($this->hashes)) {

			$params['hashes'] = $this->hashes;
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/adimages';
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
			->setUrl($this->apiPath())
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}