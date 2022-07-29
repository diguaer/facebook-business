<?php

namespace Test\FacebookAdsTests\Object;

use FacebookBusiness\FacebookAds\Common\BatchUpdateStatus;
use PHPUnit\Framework\TestCase;

class BatchUpdateStatusTest extends TestCase
{

	public function test(): void
	{
		$common = new BatchUpdateStatus();
		$common->status = 'ACTION';
		$common->ids = [];

		$this->assertIsArray($common->requestExecute());
	}

}