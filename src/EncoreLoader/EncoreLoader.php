<?php
namespace vavo\EncoreLoader;

use Nette\Application\UI\Control;
use vavo\EncoreLoader\css\CSSLoader;
use vavo\EncoreLoader\js\JSLoader;

class EncoreLoader extends Control
{
	public static $encoreConfig;

	public function __construct(array $encoreConfig)
	{
		self::$encoreConfig = $encoreConfig;
	}

	public function createComponentCss()
	{
		return new CSSLoader(self::$encoreConfig);
	}
	public function createComponentJs()
	{
		return new JSLoader(self::$encoreConfig);
	}


	public static function getAsset(string $asset)
	{
		$path = __DIR__.'/../../../www'.self::$encoreConfig['outDir'].'manifest.json';
		if (file_exists($path)) {
			$content = json_decode(file_get_contents($path), true);
			if (isset($content[$asset])) {
				return $content[$asset];
			}
		}
		return "";
	}

	public static function getEntryPoints()
	{
		$path = __DIR__.'/../../../www'.self::$encoreConfig['outDir'].'entrypoints.json';
		if (file_exists($path)) {
			$content = json_decode(file_get_contents($path), true);
			if (!isset($content['entrypoints'])) {
				return [];
			}
			return $content['entrypoints'];
		}
		return [];
	}

	public function getFiles(string $type, $entry = null)
	{
		$entryPoints = self::getEntryPoints();

		if ($entry == null) {
			$entry = $this->encoreConfig['defaultEntry'];
		}

		if (!isset($entryPoints[$entry][$type])) {
			return [];
		}
		return $entryPoints[$entry][$type];
	}
}
