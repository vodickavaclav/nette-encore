<?php
namespace vavo\EncoreLoader;

class EncoreLoaderExtension extends \Nette\DI\CompilerExtension
{
	private $defaults = [
		'outDir' => "\build",
		'defaultEntry' => 'index'
	];

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$this->validateConfig($this->defaults);

		$builder->addDefinition($this->prefix('encoreLoader'))
			->setFactory(\vavo\EncoreLoader\EncoreLoader::class, $this->config);

		$builder->addDefinition($this->prefix('encoreLoader'))
			->setFactory(\vavo\EncoreLoader\EncoreLoaderTrait::class);
	}
}
