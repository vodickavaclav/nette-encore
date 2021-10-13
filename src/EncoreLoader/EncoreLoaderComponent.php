<?php
namespace vavo\EncoreLoader;

use Nette\Application\UI\Control;
use vavo\EncoreLoader\css\CSSLoaderComponent;
use vavo\EncoreLoader\js\JSLoaderComponent;

class EncoreLoaderComponent extends Control
{

	/**
	 * @var EncoreLoaderService
	 */
	protected EncoreLoaderService $encoreLoaderService;

	public function __construct(EncoreLoaderService $encoreLoaderService)
	{
		$this->encoreLoaderService = $encoreLoaderService;
	}

	public function createComponentCss()
	{
		return new CSSLoaderComponent($this->encoreLoaderService);
	}
	public function createComponentJs()
	{
		return new JSLoaderComponent($this->encoreLoaderService);
	}
}
