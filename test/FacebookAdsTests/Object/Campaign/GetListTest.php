<?php

namespace Test\FacebookAdsTests\Object\Campaign;

use FacebookBusiness\FacebookAds\Campaign\GetList;
use PHPUnit\Framework\TestCase;

class GetListTest extends TestCase
{

	public function test(): void
	{
		$campaign = new GetList();
		$campaign->adAccountId = '';
		$campaign->accessToken = '';

		$this->assertIsArray($campaign->requestExecute());
	}

}