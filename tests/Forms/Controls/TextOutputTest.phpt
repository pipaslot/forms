<?php

use Nette\Application\UI\Form;
use Nette\Utils\Html;
use Pipas\Forms\Controls\TextOutput;
use Tester\Assert;

$container = require __DIR__ . '/../../bootstrap.php';

$form = new Form();

$output = new TextOutput("MyText");
$form->addComponent($output, 'name');

$controlElement = $output->getControl();
Assert::true($controlElement instanceof Html);