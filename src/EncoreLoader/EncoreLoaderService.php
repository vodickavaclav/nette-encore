<?php

namespace vavo\EncoreLoader;


class EncoreLoaderService
{
	/** @var string */
	private $outDir;

	/** @var string */
	private $defaultEntry;

	public function __construct(array $encoreConfig)
	{
		$this->outDir = $encoreConfig['outDir'];
		$this->defaultEntry = $encoreConfig['defaultEntry'];
	}

	public function getAsset(string $asset)
	{
		$path = $this->outDir.'manifest.json';

		if (file_exists($path)) {
			$content = json_decode(file_get_contents($path), true);
			if (isset($content[$asset])) {
				return $content[$asset];
			}
		}
		return "";
	}

	public  function getEntryPoints()
	{
		$path = $this->outDir.'entrypoints.json';
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
			$entry = $this->defaultEntry;
		}

		if (!isset($entryPoints[$entry][$type])) {
			return [];
		}
		return $entryPoints[$entry][$type];
	}
}
