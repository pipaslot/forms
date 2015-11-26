<?php

use Nette\Application\UI\Form;
use Nette\Forms\Controls\CsrfProtection;
use Nette\Neon\Exception;
use Pipas\Forms\FormFactory;
use Pipas\Forms\Rendering\Bootstrap3InlineRenderer;
use Pipas\Forms\Rendering\Bootstrap3Renderer;
use Pipas\Forms\Rendering\Bootstrap3StackRenderer;
use Tester\Assert;

$container = require __DIR__ . '/../bootstrap.php';


$factory = new FormFactory();
$testSecured = function ($form) {
	Assert::true($form instanceof Form);
	foreach ($form->controls as $control) {
		if ($control instanceof CsrfProtection) return;
	}
	Assert::fail("Protection has not been set");
};
$testInsecured = function ($form) {
	Assert::true($form instanceof Form);
	foreach ($form->controls as $control) {
		if ($control instanceof CsrfProtection) Assert::fail("Protection can not be set");
	}

};

//Secured Form
test(function () use ($factory, $testSecured) {
	$testSecured($factory->create(true));
});

//Unsecured Form
test(function () use ($factory, $testInsecured) {
	$testInsecured($factory->create(false));
});

//Bootstrap standard secured Form
test(function () use ($factory, $testSecured) {
	$form = $factory->createBootstrap(true);
	$testSecured($form);
	Assert::true($form->getRenderer() instanceof Bootstrap3Renderer);
});

//Bootstrap standard unsecured Form
test(function () use ($factory, $testInsecured) {
	$form = $factory->createBootstrap(false);
	$testInsecured($form);
	Assert::true($form->getRenderer() instanceof Bootstrap3Renderer);
});

//Bootstrap inline secured Form
test(function () use ($factory, $testSecured) {
	$form = $factory->createBootstrapInline(true);
	$testSecured($form);
	Assert::true($form->getRenderer() instanceof Bootstrap3InlineRenderer);
});

//Bootstrap inline unsecured Form
test(function () use ($factory, $testInsecured) {
	$form = $factory->createBootstrapInline(false);
	$testInsecured($form);
	Assert::true($form->getRenderer() instanceof Bootstrap3InlineRenderer);
});

//Bootstrap stacked secured Form
test(function () use ($factory, $testSecured) {
	$form = $factory->createBootstrapStacked(true);
	$testSecured($form);
	Assert::true($form->getRenderer() instanceof Bootstrap3StackRenderer);
});

//Bootstrap stacked unsecured Form
test(function () use ($factory, $testInsecured) {
	$form = $factory->createBootstrapStacked(false);
	$testInsecured($form);
	Assert::true($form->getRenderer() instanceof Bootstrap3StackRenderer);
});
