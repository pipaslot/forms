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

	/**
	 * Converts time format to moment.js format
	 * @param $format
	 * @return string
	 */
	protected function toMomentFormat($format)
	{
		$replacements = [
			'd' => 'DD',
			'D' => 'ddd',
			'j' => 'D',
			'l' => 'dddd',
			'N' => 'E',
			'S' => 'o',
			'w' => 'e',
			'z' => 'DDD',
			'W' => 'W',
			'F' => 'MMMM',
			'm' => 'MM',
			'M' => 'MMM',
			'n' => 'M',
			't' => '', // no equivalent
			'L' => '', // no equivalent
			'o' => 'YYYY',
			'Y' => 'YYYY',
			'y' => 'YY',
			'a' => 'a',
			'A' => 'A',
			'B' => '', // no equivalent
			'g' => 'h',
			'G' => 'H',
			'h' => 'hh',
			'H' => 'HH',
			'i' => 'mm',
			's' => 'ss',
			'u' => 'SSS',
			'e' => 'zz', // deprecated since version 1.6.0 of moment.js
			'I' => '', // no equivalent
			'O' => '', // no equivalent
			'P' => '', // no equivalent
			'T' => '', // no equivalent
			'Z' => '', // no equivalent
			'c' => '', // no equivalent
			'r' => '', // no equivalent
			'U' => 'X',
		];
		$momentFormat = strtr($format, $replacements);
		return $momentFormat;
	}

}