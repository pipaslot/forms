<?php


namespace Pipas\Forms\Latte;

use Nette\Bridges\FormsLatte;
use Nette\Forms\Form;
use Pipas\Forms\Rendering\IManualRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 * @internal
 */
class Runtime extends FormsLatte\Runtime
{
	/**
	 * Renders form begin.
	 * @param Form $form
	 * @param array $attrs
	 * @param bool $withTags
	 * @return string
	 */
	public static function renderFormBegin(Form $form, array $attrs, $withTags = TRUE)
	{
		$renderer = $form->getRenderer();
		if ($renderer instanceof IManualRenderer) {
			$renderer->renderFormBegin($form);
		}
		return parent::renderFormBegin($form, $attrs, $withTags);
	}
}