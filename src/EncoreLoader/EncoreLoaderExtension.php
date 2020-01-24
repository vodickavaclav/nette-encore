<?php
namespace vavo\EncoreLoader;

class EncoreLoaderExtension extends \Nette\DI\CompilerExtension
{
	private $defaults = [
		'outDir' => "\build",
		'defaultEntry' => 'index'
	];

	public function beforeCompile()
	{
		parent::beforeCompile(); // TODO: Change the autogenerated stub
		$builder = $this->getContainerBuilder();
		$builder->getDefinition('latte.latteFactory')
			->addSetup('?->onCompile[] = function($engine) { AssetMacroSet::install($engine->getCompiler()); }', ['@self']);
	}

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();
		$this->validateConfig($this->defaults);

		$builder->addDefinition($this->prefix('encoreLoader'))
			->setFactory(\vavo\EncoreLoader\EncoreLoaderFactory::class, $this->config);
	}
}