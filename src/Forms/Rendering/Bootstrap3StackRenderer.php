<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Form;

/**
 * One column form where labels are placed to controls
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap3StackRenderer extends AManualRenderer
{
	/**
	 * Bootstrap3StackedRenderer constructor.
	 */
	public function __construct()
	{
		$this->wrappers['controls']['container'] = NULL;
		$this->wrappers['pair']['container'] = 'div class=form-group';
		$this->wrappers['pair']['.error'] = 'has-error';
		$this->wrappers['control']['container'] = 'div class=col-sm-12';
		$this->wrappers['label']['container'] = null;
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
		$this->wrappers['error']['container'] = 'div class="col-sm-12"';
		$this->wrappers['error']['item'] = 'div class="alert alert-danger" role="alert"';
	}

	/**
	 * Make form and controls compatible with Twitter Bootstrap
	 * @param Form $form
	 */
	protected function prepareForm(Form $form)
	{
		$form->getElementPrototype()->class[] = 'form-horizontal';
		foreach ($form->controls as $control) {
			/** @var BaseControl $control */
			if ($control instanceof HiddenField) {
				continue;
			} elseif ($control instanceof Button) {
				$control->controlPrototype->class[] = "btn-block btn-lg";
			} else {
				if ($control->getLabel()) {
					$control->setAttribute('placeholder', $control->caption);
					if (empty($control->controlPrototype->attrs['title'])) $control->setAttribute('title', $control->caption);
					$control->getLabelPrototype()->attrs["style"] = "display:none";
				}
			}
		}
		BootstrapHelper::ApplyBootstrapToControls($form);
	}
}