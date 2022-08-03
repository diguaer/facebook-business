<?php

namespace Test\FacebookAdsTests\Object\Campaign;

use FacebookBusiness\FacebookAds\Campaign\Update;
use PHPUnit\Framework\TestCase;

class UpdateTest extends TestCase
{

	public function test(): void
	{
		$campaign = new Update();
		$campaign->campaignId = '';
		$campaign->name = 'test2';
		$campaign->accessToken = '';

		$this->assertIsArray($campaign->requestExecute());
	}

}