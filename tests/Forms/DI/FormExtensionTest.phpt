<?php

use Nette\Configurator;
use Pipas\Forms\DI\FormExtension;
use Pipas\Forms\FormFactory;
use Pipas\Forms\IFormFactory;
use Tester\Assert;

require __DIR__ . '/../../bootstrap.php';

test(function () {
	$configurator = new Configurator();
	$configurator->setTempDirectory(TEMP_DIR);
	$configurator->defaultExtensions[] = FormExtension::class;

	$container = $configurator->createContainer();

	if (!$container->findByType(FormFactory::class)) Assert::fail("Class " . FormFactory::class . " is not registered");
	if (!$container->findByType(IFormFactory::class)) Assert::fail("Interface " . IFormFactory::class . " is not registered");
});