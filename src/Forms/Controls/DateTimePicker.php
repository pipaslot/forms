<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Container;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class DateTimePicker extends ABaseDateTimeControl
{
	/**
	 * @param string $label label
	 */
	public function __construct($label = null)
	{
		parent::__construct($label, 'd.m.Y H:i');
	}

	/**
	 * Registers this control
	 *
	 * @return DateTimePicker
	 */
	public static function register()
	{
		Container::extensionMethod('addDateTime', function ($container, $name, $label = NULL) {
			$picker = $container[$name] = new DateTimePicker($label);
			return $picker;
		});
	}
}