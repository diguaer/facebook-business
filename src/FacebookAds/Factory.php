<?php
namespace FacebookBusiness\FacebookAds;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

class Factory {

	public ApiInterface $container;

	/**
	 * @throws DependencyException
	 * @throws NotFoundException
	 */
	public function __construct(string $api)
	{
		$container = new Container();
		$this->container = $container->get($api);
	}


}