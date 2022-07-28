<?php
namespace FacebookBusiness;
class ApiConfig {

	use Instance;

	public function baseConfig(): array
	{
		return [
			/**
			 * 应用appid
			 */
			'fb_appid' => env('FACE_BOOK_APPID'),

			/**
			 * 应用秘钥
			 */
			'fb_secret' => env('FACE_BOOK_SECRET'),

			/**
			 * 授权回调地址
			 */
			'fb_oauth_redirect_url' => env('FACE_BOOK_OAUTH_REDIRECT_URL'),

			/**
			 * 权限
			 */
			'fb_scope' => env('FACE_BOOK_SCOPE'),

			/**
			 * 接口域名
			 */
			'fb_api_host' => env('FACE_BOOK_API_HOST'),

			/**
			 * 接口版本
			 */
			'fb_api_version' => env('FACE_BOOK_API_VERSION'),

			/**
			 * 回调跳转地址
			 */
			'oauth_redirect_url' => env('OAUTH_REDIRECT_URL'),
		];
	}

}


