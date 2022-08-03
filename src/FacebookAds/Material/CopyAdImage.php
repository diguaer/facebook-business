<?php

namespace FacebookBusiness\FacebookAds\Material;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 将图片从一个广告账号复制到另一个广告账号（同一个fb授权的数据情况下）
 */
class CopyAdImage extends BaseParameters implements ApiInterface
{
	/**
	 * 源广告账号id(去掉act_的id)
	 * @var string
	 */
	public string $sourceAccountId;

	/**
	 * 要拷贝的源广告账号的图片hash
	 * @var string
	 */
	public string $hash;

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
			'copy_from' => [
				'source_account_id' => $this->sourceAccountId,
				'hash' => $this->hash
			]
		];

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
	 * @throws BusinessException
	 * @throws JsonException|GuzzleException
	 */
	public function requestExecute(): mixed
	{
		$request = new Request();
		return $request->setMethod($this->method())
			->setUrl($this->apiPath())
			->setApiData($this->parameters()->export())
			->execute();
	}


}