<?php

namespace vavo\EncoreLoader;

class EncoreLoaderFactory
{
	private $encoreConfig;

	public function __construct($config)
	{
		$this->encoreConfig = $config;
	}

	public function create(): EncoreLoader
	{
		return new EncoreLoader($this->encoreConfig);
	}
}
