<?php

namespace FacebookBusiness\Http;

use \GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class Client
{
	/**
	 * 执行请求
	 * @param string $url
	 * @param array $data
	 * @param string $method
	 * @param array $header
	 * @param bool $json
	 * @return mixed
	 * @throws GuzzleException
	 * @throws JsonException
	 */
	public function execute(
		string $url,
		array $data,
		string $method = Constant::HTTP_GET,
		array $header = [],
		bool $json = false
	): mixed
	{
		if (Constant::HTTP_GET === $method) {

			$params = [
				"query" => $data,
			];
		} else if ($json) {

			$params = [
				"json" => $data,
				"verify" => false,
			];
		} else {

			$params = [
				"form_params" => $data,
			];
		}

		if (!empty($header)) {

			$params["headers"] = $header;
		}

		$client = new HttpClient();
		try {
			$resp = $client->request($method, $url, $params);

			$body = $resp->getBody()->getContents();

			return json_decode($body, true, JSON_UNESCAPED_UNICODE, JSON_THROW_ON_ERROR);
		} catch (\Exception $e) {

			if ($e->hasResponse()) {

				$body = $e->getResponse()->getBody()->getContents();

				$result = json_decode($body, true, JSON_UNESCAPED_UNICODE, JSON_THROW_ON_ERROR);

				if ($result) {

					return $result;
				}
			}

			return false;
		}
	}

	/**
	 * 发送文件
	 * @param string $url
	 * @param array $data
	 * @param bool $json_encode
	 * @return mixed
	 * @throws JsonException
	 */
	public function sendFile(string $url, array $data = [], bool $json_encode = false): mixed
	{

		$curl = curl_init(); // 启动一个CURL会话
		curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 对认证证书来源的检查
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); // 从证书中检查SSL加密算法是否存在
		curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器

		if ($data != null) {
			curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
			// curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
			if (gettype($data) === "string") {
				curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			} else {
				if ($json_encode) {
					curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data, JSON_UNESCAPED_UNICODE));
				} else {
					curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				}
			}
		}
		curl_setopt($curl, CURLOPT_TIMEOUT, 300); // 设置超时限制防止死循环
		curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
		$res = curl_exec($curl); // 执行操作
		$error = curl_error($curl);
		curl_close($curl);

		$data = json_decode($res, true, JSON_UNESCAPED_UNICODE, JSON_THROW_ON_ERROR);

		return $data ?? $res;

	}

}