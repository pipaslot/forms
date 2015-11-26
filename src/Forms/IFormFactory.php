<?php

namespace Pipas\Forms;

use Nette\Application\UI\Form;
use Nette\Localization\ITranslator;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
interface IFormFactory
{
	/**
	 * Set translate adapter
	 *
	 * @param ITranslator $translator
	 * @return $this
	 */
	public function setTranslator(ITranslator $translator = null);

	/**
	 * Create standard Nette form
	 *
	 * @param bool|true $secured Enable Cross-Site Request Forgery Protection
	 * @return Form
	 */
	public function create($secured = true);
}