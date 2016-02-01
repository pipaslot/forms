<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Container;
use Nette\Forms\Controls\TextInput;
use Nette\Utils\Html;

/**
 * Require JqueryUi library
 * @author Petr Štipek <p.stipek@email.cz>
 */
class TagControl extends TextInput
{
	/**
	 * @param string $label
	 * @param string $maxLength
	 */
	public function __construct($label = NULL, $maxLength = NULL)
	{
		parent::__construct($label, $maxLength);
	}

	/**
	 * @return array
	 */
	public function getValue()
	{
		$value = parent::getValue();
		if (!$value) {
			return NULL;
		} else if (is_array($value)) {
			return $value;
		}
		return array_map(function ($value) {
			return trim($value);
		}, explode(",", $value));
	}

	/**
	 * @return Html
	 */
	public function getControl()
	{
		$control = parent::getControl();
		$control->value = implode(",", (array)$this->getValue());
		$control->addAttributes(array("data-role" => "tagsinput"));

		return $control;
	}

	/**
	 * @param mixed $value
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->rawValue = $this->value = $value;
		return $this;
	}

	/**
	 * Adds custom method of generic select box to Nette\Forms\Container
	 */
	public static function register()
	{
		Container::extensionMethod("addTags", function (Container $container, $name, $label = NULL) {
			return $container[$name] = new TagControl($label);
		});
	}
}