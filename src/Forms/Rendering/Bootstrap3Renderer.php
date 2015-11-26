<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;
use Nette\Forms\Rendering\DefaultFormRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class Bootstrap3Renderer extends DefaultFormRenderer
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
		$this->wrappers['label']['container'] = 'div class="col-sm-3 control-label"';
		$this->wrappers['control']['description'] = 'span class=help-block';
		$this->wrappers['control']['errorcontainer'] = 'span class=help-block';
		$this->wrappers['error']['container'] = 'div class="col-sm-9 col-sm-offset-3"';
		$this->wrappers['error']['item'] = 'div class="alert alert-danger" role="alert"';
	}

	/**
	 * Provides complete form rendering.
	 * @param Form $form
	 * @return string
	 */
	function render(Form $form)
	{
		// make form and controls compatible with Twitter Bootstrap
		$form->getElementPrototype()->class[] = 'form-horizontal';
		BootstrapHelper::ApplyBootstrapToControls($form);
		return parent::render($form);
	}
}