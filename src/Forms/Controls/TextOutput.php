<?php

namespace Pipas\Forms\Controls;

use Nette\Forms\Container;
use Nette\Forms\Controls\BaseControl;
use Nette\Utils\Html;

/**
 * Form extension of the text statement
 *
 * @author Petr Štipek <p.stipek@email.cz>
 */
class TextOutput extends BaseControl
{

	public static $counter = 1;

	/** @var Html container element template */
	private $container;

	/**
	 * @param  string $label
	 * @param  string $value
	 */
	public function __construct($value = NULL, $label = NULL)
	{
		parent::__construct($label);
		$this->container = Html::el();
		if ($value !== NULL) {
			$this->setValue($value);
		}
		$this->setOmitted();
	}

	/**
	 * Generates control's HTML element.
	 *
	 * @return Html
	 */
	public function getControl()
	{
		$container = clone $this->container;
		parent::getControl();
		$control = Html::el("div", array("style" => "text-align:justify"));
		$control->setHtml($this->translate((string)$this->getValue()));
		$container->add($control);

		return $container;
	}

	/**
	 * Adds addTextOutput() method to Nette\Forms\Container
	 */
	public static function register()
	{
		Container::extensionMethod('addTextOutput', function (Container $_this, $value, $label = NULL) {
			$number = TextOutput::$counter;
			TextOutput::$counter++;
			return $_this["textOutput_" . $number] = new TextOutput($value, $label);
		});
	}

}