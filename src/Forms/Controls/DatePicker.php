<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Container;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class DatePicker extends ABaseDateTimeControl
{
	/**
	 * @param string $label label
	 */
	public function __construct($label = null)
	{
		parent::__construct($label, 'd.m.Y');
	}

	/**
	 * Returns date
	 *
	 * @return \DateTime|null
	 */
	public function getValue()
	{
		$value = parent::getValue();
		if ($value instanceof \DateTime) {
			$value->setTime(0, 0, 0);
			return $value;
		}
		return $value;
	}

	/**
	 * Registers this control
	 *
	 * @return DatePicker
	 */
	public static function register()
	{
		Container::extensionMethod('addDate', function ($container, $name, $label = NULL) {
			$picker = $container[$name] = new DatePicker($label);
			return $picker;
		});
	}
}