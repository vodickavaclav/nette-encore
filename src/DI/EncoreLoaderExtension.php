<?php
namespace vavo\EncoreLoader\DI;

use Nette\Bridges\ApplicationLatte\ILatteFactory;
use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\PhpLiteral;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use vavo\EncoreLoader\EncoreLoaderFactory;
use vavo\EncoreLoader\EncoreLoaderService;
use vavo\EncoreLoader\macro\AssetMacroSet;

class EncoreLoaderExtension extends CompilerExtension
{
	private $defaults = [
		'outDir' => '\build',
		'defaultEntry' => 'index'
	];


	public function loadConfiguration()
	{
		$this->validateConfig($this->defaults);

		$builder = $this->getContainerBuilder();

		$encoreLoaderService = $builder->addDefinition($this->prefix('encoreLoaderService'))
			->setFactory(EncoreLoaderService::class, [(array) $this->config]);

		$builder->getDefinitionByType(ILatteFactory::class)
			->addSetup('addProvider', ['name' => 'encoreLoaderService', 'value' => $encoreLoaderService])
			->addSetup('?->onCompile[] = function ($engine) { ?::install( $engine->getCompiler()); }', [
				'@self',
				new PhpLiteral(AssetMacroSet::class)
			]);

		$builder->addDefinition($this->prefix('encoreLoaderFactory'))
			->setFactory(EncoreLoaderFactory::class);
	}
}
