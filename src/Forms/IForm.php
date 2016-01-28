<?php

namespace Pipas\Forms;

use Nette;
use Pipas\Forms\Controls\CountrySelectBox;
use Pipas\Forms\Controls\DatePicker;
use Pipas\Forms\Controls\DateTimePicker;
use Pipas\Forms\Controls\TextOutput;

/**
 * Interface used only for annotation suggestions
 * @author Petr Štipek <p.stipek@email.cz>
 * @internal
 */
interface IForm
{
	/**
	 * Adds naming container to the form.
	 * @param  string $name
	 * @return Nette\Forms\Container|IForm
	 */
	function addContainer($name);

	/**
	 * Translated country selection
	 * @param string $name
	 * @param string|null $label
	 * @return CountrySelectBox
	 */
	function addCountry($name, $label = NULL);

	/**
	 * Twitter bootstrap date picker
	 * @param string $name
	 * @param string|null $label
	 * @return DatePicker
	 */
	function addDate($name, $label = NULL);

	/**
	 * Twitter bootstrap datetime picker
	 * @param string $name
	 * @param string|null $label
	 * @return DateTimePicker
	 */
	function addDateTime($name, $label = NULL);

	/**
	 * Twitter bootstrap datetime picker
	 * @param string $value Plain text or HTML
	 * @param string|null $label
	 * @return TextOutput
	 */
	function addTextOutput($value, $label = NULL);
}