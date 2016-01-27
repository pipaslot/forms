<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Container;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Helpers;
use Nette\Utils\Html;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class CountrySelectBox extends SelectBox
{
	/**
	 * List of supported country codes
	 * @var array
	 */
	public static $countries = array();

	public function __construct($label)
	{
		parent::__construct($label, self::$countries);
	}


	/**
	 * Generates control's HTML element.
	 * @return Html
	 */
	public function getControl()
	{
		$items = $this->prompt === FALSE ? array() : array('' => $this->translate($this->prompt));
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
	 * Adds addCountry() method to Nette\Forms\Container
	 */
	public static function register()
	{
		Container::extensionMethod('addCountry', function (Container $container, $name, $label = NULL) {
			return $container[$name] = new CountrySelectBox($label);
		});
	}
}