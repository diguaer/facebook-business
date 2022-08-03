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
 * 获取素材图片
 */
class GetAdImagesList extends BaseParameters implements ApiInterface
{
	/**
	 * 素材名称
	 * @var string
	 */
	public string $name = '';

	/**
	 * 图片hash
	 * [hash1,hash2,......]
	 * @var array
	 */
	public array $hashes = [];

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'fields' => !empty($this->fields) ? $this->fields : 'account_id,name,permalink_url,status,hash,width,height,url_128',
			'access_token' => $this->accessToken,
			'limit' => $this->getDefaultLimit()
		];

		if (!empty($this->name)) {

			$params['name'] = $this->name;
		}

		if (!empty($this->hashes)) {

			$params['hashes'] = $this->hashes;
		}

		$params = array_merge($params, $this->setDefaultListParamsByVerify());

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
			->setLanguage($this->locale)
			->setApiData($this->parameters()->export())
			->setRequestJson(false)
			->execute();
	}


}