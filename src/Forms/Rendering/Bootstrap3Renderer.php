<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap3Renderer extends AManualRenderer
{
	/**
	 * Bootstrap3Renderer constructor.
	 */
	public function __construct()
	{
		$this->wrappers['controls']['container'] = NULL;
		$this->wrappers['pair']['container'] = 'div class=form-group';
		$this->wrappers['pair']['.error'] = 'has-error';
		$this->wrappers['control']['container'] = 'div class=col-sm-9';
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
		$this->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
		$this->wrappers['error']['container'] = 'div class="col-sm-9 col-sm-offset-3"';
		$this->wrappers['error']['item'] = 'div class="alert alert-danger" role="alert"';
		$this->wrappers['group']['container'] = 'fieldset class=form-group';
		$this->wrappers['group']['label'] = 'legend class="col-sm-9 col-sm-offset-3"';
	}

	/**
	 * Make form and controls compatible with Twitter Bootstrap
	 * @param Form $form
	 */
	protected function prepareForm(Form $form)
	{
		$form->getElementPrototype()->class[] = 'form-horizontal';
		BootstrapHelper::ApplyBootstrapToControls($form);
	}
}