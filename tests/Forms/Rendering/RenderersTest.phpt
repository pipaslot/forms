<?php

use Nette\Application\UI\Form;
use Pipas\Forms\Rendering\Bootstrap4InlineRenderer;
use Pipas\Forms\Rendering\Bootstrap4Renderer;
use Pipas\Forms\Rendering\Bootstrap4StackRenderer;

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
	$renderer = new Bootstrap4InlineRenderer();
	$renderer->render($form);
});

test(function () use ($form) {
	$renderer = new Bootstrap4Renderer();
	$renderer->render($form);
});

test(function () use ($form) {
	$renderer = new Bootstrap4StackRenderer();
	$renderer->render($form);
});
