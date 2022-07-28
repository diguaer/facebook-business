<?php

namespace Test\FacebookAdsTests\Object;

use FacebookBusiness\FacebookAds\Campaign\Create;
use PHPUnit\Framework\TestCase;

class CreateTest extends TestCase
{

	public function test(): void
	{
		$campaign = new Create();
		$campaign->adAccountId = '';
		$campaign->bidStrategy = '';
		$campaign->buyingType = 'AUCTION';
		$campaign->dailyBudget = 0;
		$campaign->lifetimeBudget = 0;
		$campaign->name = 'test';
		$campaign->objective = 'REACH';
		$campaign->pacingType = ["standard"];
		$campaign->spendCap = 0;
		$campaign->accessToken = '';

		$this->assertIsArray($campaign->requestExecute());
	}

}