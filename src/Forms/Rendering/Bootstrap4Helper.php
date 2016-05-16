<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Controls;
use Nette\Forms\Form;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap4Helper
{
	/**
	 * @param Form $form
	 */
	public static function ApplyBootstrapToControls(Form $form)
	{
		$usedPrimary = FALSE;
		$form->getElementPrototype()->class[] = 'bootstrap-theme';
		foreach ($form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-secondary');
				$usedPrimary = TRUE;
			} elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');
			} elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}
	}
}