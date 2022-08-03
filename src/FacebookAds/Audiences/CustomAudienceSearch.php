<?php
namespace FacebookBusiness\FacebookAds\Audiences;

use FacebookBusiness\Exception\FBusinessException;
use FacebookBusiness\FacebookAds\ApiInterface;
use FacebookBusiness\FacebookAds\BaseParameters;
use FacebookBusiness\FacebookAds\Parameters;
use FacebookBusiness\Http\Constant;
use FacebookBusiness\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

/**
 * 搜索自定义受众
 */
class CustomAudienceSearch extends BaseParameters implements ApiInterface
{

	/**
	 * 受众id
	 * @var string
	 */
	public string $type = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'access_token' => $this->accessToken,
			'fields' => !empty($this->fields) ? $this->fields : '["id","name","subtype","description","rule","origin_audience_id","targeting","approximate_count_64bit","approximate_count_lower_bound","approximate_count_upper_bound","is_sharing_agreement_needed","sentence_lines","permission_for_actions","targeting_status","shared_account_info"]'
		];

		$params = array_merge($params, $this->setDefaultListParamsByVerify());

		/**
		 * 类似受众价值来源列表不需要显示类似受众
		 */
		if ('source_list' === $this->type) {

			$params['filtering'] = '[{"field":"subtype","operator":"NOT_EQUAL","value":"LOOKALIKE"}]';
		} elseif ($this->keyword) {

			$params['filtering'] = '[{"field":"name","operator":"NOT_EQUAL","value":"' . $this->keyword . '"}]';
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/customaudiences';
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