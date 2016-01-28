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
	 * @param bool|true $secured Enable Cross-Site Request Forgery Protection
	 * @return Form|IForm
	 */
	public function create($secured = true);

	/**
	 * Create Form with Bootstrap styling
	 * @param bool|true $secured
	 * @return Form|IForm
	 */
	public function createBootstrap($secured = true);

	/**
	 * Create Form with inline Bootstrap styling
	 * @param bool|true $secured
	 * @return Form|IForm
	 */
	public function createBootstrapInline($secured = true);

	/**
	 * One column form where labels are placed to controls
	 * @param bool|true $secured
	 * @return Form|IForm
	 */
	public function createBootstrapStacked($secured = true);
}