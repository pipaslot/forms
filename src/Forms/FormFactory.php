<?php


namespace Pipas\Forms;

use Nette\Application\UI\Form;
use Nette\Localization\ITranslator;
use Pipas\Forms\Rendering\Bootstrap3InlineRenderer;
use Pipas\Forms\Rendering\Bootstrap3Renderer;
use Pipas\Forms\Rendering\Bootstrap3StackRenderer;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class FormFactory implements IFormFactory
{
	/** @var ITranslator */
	private $translator;

	/**
	 * Set translate adapter
	 *
	 * @param ITranslator $translator
	 * @return $this
	 */
	public function setTranslator(ITranslator $translator = null)
	{
		$this->translator = $translator;
		return $this;
	}

	/**
	 * Create standard Nette form
	 * @param bool|true $secured Enable Cross-Site Request Forgery Protection
	 * @return Form|IForm
	 */
	public function create($secured = true)
	{
		$form = new Form();
		if ($secured) $form->addProtection('Vypršel časový limit, odešlete formulář znovu');
		$form->setTranslator($this->translator);
		return $form;
	}

	/**
	 * Create Form with Bootstrap styling
	 * @param bool|true $secured
	 * @return Form|IForm
	 */
	public function createBootstrap($secured = true)
	{
		$form = $this->create($secured);
		$form->setRenderer(new Bootstrap3Renderer());
		return $form;
	}

	/**
	 * Create Form with inline Bootstrap styling
	 * @param bool|true $secured
	 * @return Form|IForm
	 */
	public function createBootstrapInline($secured = true)
	{
		$form = $this->create($secured);
		$form->setRenderer(new Bootstrap3InlineRenderer());
		return $form;
	}

	/**
	 * One column form where labels are placed to controls
	 * @param bool|true $secured
	 * @return Form|IForm
	 */
	public function createBootstrapStacked($secured = true)
	{
		$form = $this->create($secured);
		$form->setRenderer(new Bootstrap3StackRenderer());
		return $form;
	}
}