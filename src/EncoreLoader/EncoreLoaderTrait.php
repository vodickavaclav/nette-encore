<?php
namespace vavo\EncoreLoader;

trait EncoreLoaderTrait
{
	/** @var EncoreLoaderFactory @inject */
	public EncoreLoaderFactory $loader;

	protected function createComponentEncore(): EncoreLoaderComponent
	{
		return $this->loader->create();
	}
}
