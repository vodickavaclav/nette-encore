<?php
namespace vavo\EncoreLoader\css;

use vavo\EncoreLoader\EncoreLoader;

class CSSLoader extends EncoreLoader
{
	const TYPE = 'css';

	public function render($entry = null)
	{
		$this->template->files = self::getFiles(self::TYPE, $entry);
		$this->template->setFile(__DIR__ . '/CSSLoader.latte');
		$this->template->render();
	}
}
