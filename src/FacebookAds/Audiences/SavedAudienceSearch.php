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
 * 搜索保存受众
 */
class SavedAudienceSearch extends BaseParameters implements ApiInterface
{

	/**
	 * 保存受众名称
	 * @var string
	 */
	public string $filterName = '';

	/**
	 * 参数
	 * @return Parameters
	 */
	public function parameters(): Parameters
	{

		$params = [
			'sort' => 'time_created_descending',
			'access_token' => $this->accessToken,
			'fields' => !empty($this->fields) ? $this->fields : '["id","name","subtype","description","targeting","approximate_count_lower_bound","approximate_count_upper_bound","sentence_lines","permission_for_actions"]'
		];

		$params = array_merge($params, $this->setDefaultListParamsByVerify());

		if ($this->filterName) {

			$params['filtering'] = '[{"field":"name","operator":"CONTAIN","value":"' . $this->filterName . '"}]';
		}

		return new Parameters($params);
	}

	/**
	 * 接口地址
	 * @return string
	 */
	public function apiPath(): string
	{
		return '/' . $this->adAccountId . '/saved_audiences';
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