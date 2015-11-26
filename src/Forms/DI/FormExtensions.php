<?php
namespace Pipas\Forms\DI;

use Nette\DI\CompilerExtension;
use Nette\PhpGenerator\ClassType;
use Pipas\Forms\Controls\TextOutput;
use Pipas\Forms\FormFactory;

/**
 * Registers helper methods 'addTextOutput'
 * and corresponding Latte macros for convenient manual rendering
 *
 * @author Petr Štipek
 */
class FormExtension extends CompilerExtension
{
	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();
		//Register form factory
		$container->addDefinition($this->prefix('formFactory'))
			->setClass(FormFactory::class);
	}
	public function afterCompile(ClassType $class)
	{
		$methods = $class->getMethods();
		$initialize = $methods['initialize'];
		$initialize->addBody(TextOutput::class.'::register();');
	}
}