<?php
namespace vavo\EncoreLoader\js;

use vavo\EncoreLoader\EncoreLoader;

class JSLoader extends EncoreLoader
{
	const TYPE = 'js';

	public function render($entry = null)
	{
		$this->template->files = self::getFiles(self::TYPE, $entry);
		$this->template->setFile(__DIR__ . '/JSLoader.latte');
		$this->template->render();
	}
}
