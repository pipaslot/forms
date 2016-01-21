<?php

namespace Pipas\Forms\Latte;

use Latte\MacroNode;
use Latte\PhpWriter;
use Nette\Bridges\FormsLatte;
use Pipas\Forms\Rendering\IManualRenderer;

/**
 * Override default Form macros
 * @author Petr Štipek <p.stipek@email.cz>
 */
class FormMacros extends FormsLatte\FormMacros
{

	public function macroForm(MacroNode $node, PhpWriter $writer)
	{
		return $this->getBeforeRenderCalling($writer) . parent::macroForm($node, $writer);
	}

	public function macroLabel(MacroNode $node, PhpWriter $writer)
	{
		return $this->getBeforeRenderCalling($writer) . parent::macroLabel($node, $writer);
	}

	public function macroFormContainer(MacroNode $node, PhpWriter $writer)
	{
		return $this->getBeforeRenderCalling($writer) . parent::macroFormContainer($node, $writer);
	}

	public function macroInput(MacroNode $node, PhpWriter $writer)
	{
		return $this->getBeforeRenderCalling($writer) . parent::macroInput($node, $writer);
	}

	/**
	 * @param PhpWriter $writer
	 * @return string
	 */
	private function getBeforeRenderCalling(PhpWriter $writer)
	{
		return $writer->write('$formRenderer = $_form->getRenderer();'
			. 'if($formRenderer instanceof ' . IManualRenderer::class . '){ $formRenderer->beforeRender($_form); }');
	}
}