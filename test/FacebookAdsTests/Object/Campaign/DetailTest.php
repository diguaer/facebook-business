<?php

namespace Test\FacebookAdsTests\Object\Campaign;


use FacebookBusiness\FacebookAds\Campaign\Detail;
use FacebookBusiness\FacebookAds\Factory;
use PHPUnit\Framework\TestCase;

class DetailTest extends TestCase
{

	public function test(): void
	{

//		$detail = new Factory(Detail::class);
//		$detail->container->campaignId = '';
//		$detail->container->accessToken = '';
//		$detail->container->requestExecute();

		$campaign = new Detail();
		$campaign->campaignId = '';
		$campaign->accessToken = '';

		$this->assertIsArray($campaign->requestExecute());
	}

}