<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Controls\BaseControl;
use Nette\Forms\Controls\Button;
use Nette\Forms\Controls\HiddenField;
use Nette\Forms\Form;
use Nette\Forms\Rendering\DefaultFormRenderer;

/**
 * One column form where labels are placed to controls
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap3StackRenderer extends DefaultFormRenderer implements IManualRenderer
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
	private function beforeRender(Form $form)
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

	/**
	 * Provides complete form rendering.
	 * @param Form $form
	 * @return string
	 */
	function render(Form $form)
	{
		$this->beforeRender($form);
		return parent::render($form);
	}

	/**
	 * Prepares additional styling to form controls before manual rendering. DO not forget register macros.
	 * @param Form $form
	 * @return string
	 */
	function renderFormBegin(Form $form)
	{
		$this->beforeRender($form);
	}
}