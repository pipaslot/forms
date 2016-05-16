<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap4InlineRenderer extends AManualRenderer
{
	/**
	 * Bootstrap3InlineRenderer constructor.
	 */
	public function __construct()
	{
		$this->wrappers['controls']['container'] = NULL;
		$this->wrappers['pair']['container'] = 'div class=form-group';
		$this->wrappers['pair']['.error'] = 'has-error';
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
	}

	/**
	 * Make form and controls compatible with Twitter Bootstrap
	 * @param Form $form
	 */
	protected function prepareForm(Form $form)
	{
		$form->getElementPrototype()->class[] = 'form-inline';
		Bootstrap4Helper::ApplyBootstrapToControls($form);
	}

}