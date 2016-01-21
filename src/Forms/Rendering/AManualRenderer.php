<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;
use Nette\Forms\Rendering\DefaultFormRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
abstract class AManualRenderer extends DefaultFormRenderer implements IManualRenderer
{
	/** @var bool */
	private $initialized = false;

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
	 * @internal Called only from macro
	 */
	public function renderFormBegin(Form $form)
	{
		$this->beforeRender($form);
	}

	public function beforeRender(Form $form)
	{
		if ($this->initialized) return;
		$this->prepareForm($form);
		$this->initialized = true;
	}

	protected abstract function prepareForm(Form $form);


}