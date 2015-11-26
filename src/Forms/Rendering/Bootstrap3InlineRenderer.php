<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;
use Nette\Forms\Rendering\DefaultFormRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap3InlineRenderer extends DefaultFormRenderer
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
	 * Provides complete form rendering.
	 * @param Form $form
	 * @return string
	 */
	function render(Form $form)
	{
		// make form and controls compatible with Twitter Bootstrap
		$form->getElementPrototype()->class[] = 'form-inline';
		BootstrapHelper::ApplyBootstrapToControls($form);
		return parent::render($form);
	}
}