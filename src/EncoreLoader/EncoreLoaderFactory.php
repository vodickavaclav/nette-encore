<?php

namespace vavo\EncoreLoader;

interface EncoreLoaderFactory
{
	/**
	 * @return EncoreLoaderComponent
	 */
	public function create(): EncoreLoaderComponent;
}
