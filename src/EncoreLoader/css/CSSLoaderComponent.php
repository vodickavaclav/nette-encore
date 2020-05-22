<?php
namespace vavo\EncoreLoader\css;

use vavo\EncoreLoader\EncoreLoaderComponent;

class CSSLoaderComponent extends EncoreLoaderComponent
{
	const TYPE = 'css';

	public function render($entry = null)
	{
		$this->template->files = $this->encoreLoaderService->getFiles(self::TYPE, $entry);
		$this->template->setFile(__DIR__ . '/CSSLoader.latte');
		$this->template->render();
	}
}
