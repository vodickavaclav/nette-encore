<?php
namespace App\Components\EncoreLoader;

use Latte;

class AssetMacroSet extends Latte\Macros\MacroSet
{
	/**
	 * @param \Latte\Compiler $compiler
	 *
	 * @return void
	 */
	public static function install(Latte\Compiler $compiler): void
	{
		$me = new static($compiler);
		$me->addMacro('asset', [$me, 'macroAsset']);
	}

	public function macroAsset(Latte\MacroNode $node, Latte\PhpWriter $writer): string
	{

		return $writer->write('echo %escape(%modify(\App\Components\EncoreLoader\EncoreLoader::getAsset(%node.args)))');
	}
}
