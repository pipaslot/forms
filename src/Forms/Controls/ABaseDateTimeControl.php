<?php


namespace Pipas\Forms\Controls;

use Nette\Forms\Controls\TextInput;
use Nette\Forms\Form;
use Nette\Forms\Validator;
use Nette\Utils\Html;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class ABaseDateTimeControl extends TextInput
{
	protected $container;
	/** @var string Default format */
	protected $format;

	/**
	 * @param string $label label
	 * @param string $format
	 */
	public function __construct($label = null, $format = 'd.m.Y H:i')
	{
		parent::__construct($label, null);
		$this->container = Html::el("div");
		$this->format = $format;
	}

	/**
	 * Sets custom format
	 *
	 * @param string $format format
	 * @return self
	 */
	public function setFormat($format)
	{
		$this->format = $format;
		return $this;
	}

	/**
	 * Returns date
	 *
	 * @return \DateTime|null
	 */
	public function getValue()
	{
		if (strlen($this->value) > 0) {
			return \DateTime::createFromFormat($this->format, $this->value);
		}
		return null;
	}

	/**
	 * Sets date
	 *
	 * @param string $value date
	 * @return void
	 */
	public function setValue($value)
	{
		if ($value instanceof \DateTime)
			$value = $value->format($this->format);
		parent::setValue($value);
	}

	/**
	 * @return mixed
	 */
	public function getRawValue()
	{
		return parent::getValue();
	}

	/**
	 * @return bool
	 */
	public function isFilled()
	{
		$value = $this->getRawValue();
		return $value !== NULL;
	}

	/**
	 * @param ABaseDateTimeControl $control
	 * @return bool
	 */
	public function validateDate(ABaseDateTimeControl $control)
	{
		return $control->isDisabled() || !$control->isFilled() || $control->getValue() !== NULL;
	}

	/**
	 * Generates control's HTML element.
	 *
	 * @return Html
	 */
	public function getControl()
	{
		$control = parent::getControl();
		$control->addAttributes(array("data-format" => $this->format));
		$container = clone $this->container;
		$container->class[] = 'input-group date';
		$container->add($control);
		$container->add('<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>');

		return $container;
	}

	/**
	 * @param string|bool $message
	 * @return $this
	 */
	public function setRequired($message = TRUE)
	{
		parent::setRequired($message);
		$this->addRule(function (ABaseDateTimeControl $control) {
			return $this->validateDate($control);
		}, is_string($message) ? $message : Validator::$messages[Form::FILLED]);
		return $this;
	}
}