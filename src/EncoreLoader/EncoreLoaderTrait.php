<?php
namespace vavo\EncoreLoader;

trait EncoreLoaderTrait
{
	/** @var EncoreLoaderFactory @inject */
	public $loader;

	protected function createComponentEncore(): EncoreLoader
	{
		return $this->loader->create();
	}
}
