<?php

namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\BusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 搜索共享受众账号
 */
class AudienceSharingAccountValid extends BaseParameters implements ApiInterface
{

	/**
	 * 搜索的广告账号
	 * @var string
	 */
	public string $recipientAdAccountId = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{
		if (empty($this->fields)) {

			$this->fields = '["account_id","account_type","business_id","business_name","sharing_agreement_status","can_ad_account_use_lookalike_container"]';
		}

		$params = [
			'access_token' => $this->accessToken,
			'fields' => $this->fields,
			'recipient_adaccount' => $this->recipientAdAccountId
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
		return '/' . $this->adAccountId .'/audiencesharing_accountvalid';
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