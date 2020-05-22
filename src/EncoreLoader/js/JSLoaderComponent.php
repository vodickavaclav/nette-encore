<?php
namespace vavo\EncoreLoader\js;

use vavo\EncoreLoader\EncoreLoaderComponent;

class JSLoaderComponent extends EncoreLoaderComponent
{
	const TYPE = 'js';

	public function render($entry = null)
	{
		$this->template->files = $this->encoreLoaderService->getFiles(self::TYPE, $entry);
		$this->template->setFile(__DIR__ . '/JSLoader.latte');
		$this->template->render();
	}
}
