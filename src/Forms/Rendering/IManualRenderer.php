<?php


namespace Pipas\Forms\Rendering;

use Nette\Forms\Form;
use Nette\Forms\IFormRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
interface IManualRenderer extends IFormRenderer
{
	/**
	 * Prepares additional styling to form controls before manual rendering. DO not forget register macros.
	 * @param Form $form
	 * @return string
	 */
	function beforeRender(Form $form);
}