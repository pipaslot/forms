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
		$usedPrimary = false;
		$form->getElementPrototype()->class[] = 'bootstrap-theme';
		foreach ($form->getControls() as $control) {
			if ($control instanceof Controls\Button) {
				$currentClasses = $control->getControlPrototype()->getAttribute('class');

				if (!self::hasBtnDefinition($currentClasses)) {
					$control->getControlPrototype()->addClass(!$usedPrimary ? 'btn-primary' : 'btn-secondary');
					$usedPrimary = TRUE;
				}
				$control->getControlPrototype()->addClass('btn');
			} elseif ($control instanceof Controls\TextBase || $control instanceof Controls\SelectBox || $control instanceof Controls\MultiSelectBox) {
				$control->getControlPrototype()->addClass('form-control');
			} elseif ($control instanceof Controls\Checkbox || $control instanceof Controls\CheckboxList || $control instanceof Controls\RadioList) {
				$control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
			}
		}
	}

	/**
	 * @param string|array $currentClasses
	 * @return bool
	 */
	private static function hasBtnDefinition($currentClasses){
		$classes = is_array($currentClasses) ? $currentClasses : array($currentClasses);
		foreach ($classes as $class){
			if (strpos($class, 'btn-secondary') >=0 OR  strpos($class, 'btn-primary') >=0 ) {
				return true;
			}
		}
		return false;
	}
}