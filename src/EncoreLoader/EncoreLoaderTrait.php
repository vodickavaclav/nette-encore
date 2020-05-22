<?php
namespace vavo\EncoreLoader;

trait EncoreLoaderTrait
{
	/** @var EncoreLoaderFactory @inject */
	public $loader;

	protected function createComponentEncore(): EncoreLoaderComponent
	{
		return $this->loader->create();
	}
}
