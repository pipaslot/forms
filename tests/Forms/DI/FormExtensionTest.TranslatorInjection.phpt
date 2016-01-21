<?php

namespace Pipas\Forms\DI;

use Nette\Configurator;
use Nette\Localization\ITranslator;
use Pipas\Forms\FormFactory;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';

class TestingTranslator implements ITranslator
{
	public function translate($message, $count = NULL)
	{

	}
}


$configurator = new Configurator();
$configurator->setTempDirectory(TEMP_DIR);
$configurator->addConfig(__DIR__ . "/config.translatorInjection.neon");
$container = $configurator->createContainer();

/** @var FormFactory $factory */
$name = $container->findByType(FormFactory::class);
Assert::equal(1, count($name));
$factory = $container->getService($name[0]);
$form = $factory->create();
Assert::notSame(null, $form->getTranslator());
Assert::equal(TestingTranslator::class, get_class($form->getTranslator()));

