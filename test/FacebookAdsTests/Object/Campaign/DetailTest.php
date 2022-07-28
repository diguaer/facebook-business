<?php

namespace Test\FacebookAdsTests\Object;

use FacebookBusiness\FacebookAds\Campaign\Detail;
use PHPUnit\Framework\TestCase;

class DetailTest extends TestCase
{

	public function test(): void
	{
		$campaign = new Detail();
		$campaign->campaignId = '';
		$campaign->accessToken = '';

		$this->assertIsArray($campaign->requestExecute());
	}

}