<?php

namespace vavo\EncoreLoader;


class EncoreLoaderService
{
	/** @var string */
	private $outDir;

	/** @var string */
	private $defaultEntry;

	/** @var string[] */
	private $files = [];

	public function __construct(array $encoreConfig)
	{
		$this->outDir = $encoreConfig['outDir'];
		$this->defaultEntry = $encoreConfig['defaultEntry'];
	}

	public function getAsset(string $asset)
	{
		$path = realpath($this->outDir). DIRECTORY_SEPARATOR .'manifest.json';

		if (file_exists($path)) {
			$content = json_decode(file_get_contents($path), true);
			if (isset($content[$asset])) {
				return $content[$asset];
			}

			$foundAssets = preg_grep("/".preg_quote($asset, '/')."$/", array_keys($content));

			if (count($foundAssets)) {
				return $content[current($foundAssets)];
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

		return $this->checkDuplicity($entryPoints[$entry][$type]);
	}

	private function checkDuplicity(array $entryPoints)
	{
		foreach ($entryPoints as $key => $entryPoint) {
			if (in_array($entryPoint, $this->files, true)) {
				unset($entryPoints[$key]);
			} else {
				$this->files[] = $entryPoint;
			}
		}

		return $entryPoints;
	}

	public function setOutDir(string $outDir): void
	{
		$this->outDir = $outDir;
	}
}
