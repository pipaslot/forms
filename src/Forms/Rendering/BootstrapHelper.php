<?php


namespace Pipas\Forms\Rendering;

use Nette\Application\UI\Form;
use Nette\Forms\Controls;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class BootstrapHelper
{
	/**
	 * @param Form $form
	 */
	public static function ApplyBootstrapToControls(Form $form)
	{
		$usedPrimary = FALSE;
		foreach ($form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
				$usedPrimary = TRUE;
			} elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');
			} elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}
	}
}