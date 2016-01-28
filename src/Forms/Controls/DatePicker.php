<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Container;
use Nette\Utils\Html;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class DateTimePicker extends ABaseDateTimeControl
{
	private static $firstRender = true;

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
	 * Generates control's HTML element.
	 *
	 * @return Html
	 */
	public function getControl()
	{
		$container = clone $this->container;
		$container->class[] = 'input-group date';
		$container->add(parent::getControl());
		$container->add('<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>');
		if (self::$firstRender) {
			$container->add('<script type="text/javascript">pipas.bower.get(["moment/min/moment.min.js","moment/min/locales.min.js","eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js","eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"],function(){$("form .input-group.date").datetimepicker({locale: pipas.locale(),format: \'' . $this->toMomentFormat($this->format) . '\'});});</script>');
			$container->add('<style>.input-group.date .help-block.text-danger{display: table-row;}</style>');
			self::$firstRender = false;
		}
		return $container;
	}

	/**
	 * Registers this control
	 *
	 * @return DateTimePicker
	 */
	public static function register()
	{
		Container::extensionMethod('addDate', function ($container, $name, $label = NULL) {
			$picker = $container[$name] = new DateTimePicker($label);
			return $picker;
		});
	}
}