<?php

use Nette\Application\UI\Form;
use Pipas\Forms\Rendering\Bootstrap3InlineRenderer;
use Pipas\Forms\Rendering\Bootstrap3Renderer;
use Pipas\Forms\Rendering\Bootstrap3StackRenderer;

require __DIR__ . '/../../bootstrap.php';


$form = new Form();
$form->addText("text");
$form->addSelect("select");
$form->addGroup("group");
$form->addContainer("cnt")
	->addText("cnttext");
$form->addSubmit("submit");
$form->addButton("buttom");
$form->addCheckbox("checkbox");
$form->addMultiSelect("multiselect");
$form->addHidden("hidden");
$form->addRadioList("dadion");

test(function () use ($form) {
	$renderer = new Bootstrap3InlineRenderer();
	$renderer->render($form);
});

test(function () use ($form) {
	$renderer = new Bootstrap3Renderer();
	$renderer->render($form);
});

test(function () use ($form) {
	$renderer = new Bootstrap3StackRenderer();
	$renderer->render($form);
});
