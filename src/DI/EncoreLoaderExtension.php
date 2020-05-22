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
	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'outDir' => Expect::string()->default('\build'),
			'defaultEntry' => Expect::string()->default('index')
		]);
	}


	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$encoreLoaderService = $builder->addDefinition($this->prefix('encoreLoaderService'))
			->setFactory(EncoreLoaderService::class, [(array) $this->config]);

		$builder->getDefinitionByType(ILatteFactory::class)
			->getResultDefinition()
			->addSetup('addProvider', ['name' => 'encoreLoaderService', 'value' => $encoreLoaderService])
			->addSetup('?->onCompile[] = function ($engine) { ?::install( $engine->getCompiler()); }', [
				'@self',
				new PhpLiteral(AssetMacroSet::class)
			]);

		$builder->addFactoryDefinition($this->prefix('encoreLoaderFactory'))
			->setImplement(EncoreLoaderFactory::class);
	}
}
