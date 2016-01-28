<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Container;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Helpers;
use Nette\Utils\Html;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class GenericSelectBox extends SelectBox
{
	/**
	 * Generates control's HTML element.
	 * @return Html
	 */
	public function getControl()
	{
		$items = $this->getPrompt() === FALSE ? array() : array('' => $this->translate($this->getPrompt()));
		$translated = array();
		foreach ($this->items as $key => $value) {
			$translated[$key] = $this->translate($value);
		}
		asort($translated);
		return Helpers::createSelectBox(
			$items + $translated,
			array(
				'selected?' => $this->value,
				'disabled:' => is_array($this->disabled) ? $this->disabled : NULL,
			)
		)->addAttributes(parent::getControl()->attrs);
	}

	/**
	 * Adds custom method of generic select box to Nette\Forms\Container
	 * @param $method
	 * @param array|null $items
	 */
	public static function register($method, $items = null)
	{
		Container::extensionMethod($method, function (Container $container, $name, $label = NULL) use ($items) {
			return $container[$name] = new GenericSelectBox($label, $items);
		});
	}
}