<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;
use Nette\Forms\Rendering\DefaultFormRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap3InlineRenderer extends DefaultFormRenderer implements IManualRenderer
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
	private function beforeRender(Form $form)
	{
		$form->getElementPrototype()->class[] = 'form-inline';
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