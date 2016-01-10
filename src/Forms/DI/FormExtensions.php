<?php
namespace Pipas\Forms\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use Nette\PhpGenerator\ClassType;
use Pipas\Forms\Controls\TextOutput;
use Pipas\Forms\FormFactory;
use Pipas\Forms\Latte\FormMacros;

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

		//setup macros
		$latteFactory = $this->getLatteFactory();
		$latteFactory->addSetup('?->onCompile[] = function($engine) { ' . FormMacros::class . '::install($engine->getCompiler()); }', array('@self'));
	}

	public function afterCompile(ClassType $class)
	{
		$methods = $class->getMethods();
		$initialize = $methods['initialize'];
		$initialize->addBody(TextOutput::class . '::register();');
	}

	/**
	 * @return ServiceDefinition
	 */
	private function getLatteFactory()
	{
		$builder = $this->getContainerBuilder();
		return $builder->hasDefinition('nette.latteFactory')
			? $builder->getDefinition('nette.latteFactory')
			: $builder->getDefinition('nette.latte');
	}

}