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

	public static function getEncoreConfig(string $config)
	{
		if(isset(self::$encoreConfig[$config])) {
			return self::$encoreConfig[$config];
		}

		return null;
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
		$path = self::getEncoreConfig('outDir').'manifest.json';
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
		$path = self::getEncoreConfig('outDir').'entrypoints.json';
		if (file_exists($path)) {
			$content = json_decode(file_get_contents($path), true);
			if (!isset($content['entrypoints'])) {
				return [];
			}
			return $content['entrypoints'];
		}
		return [];
	}

	public static function getFiles(string $type, $entry = null)
	{
		$entryPoints = self::getEntryPoints();

		if ($entry == null) {
			$entry = self::getEncoreConfig('defaultEntry');
		}

		if (!isset($entryPoints[$entry][$type])) {
			return [];
		}
		return $entryPoints[$entry][$type];
	}
}
