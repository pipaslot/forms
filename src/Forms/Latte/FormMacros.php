<?php

namespace Pipas\Forms\Latte;

use Latte\CompileException;
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
		if ($node->modifiers) {
			trigger_error('Modifiers are not allowed here.', E_USER_WARNING);
		}
		if ($node->prefix) {
			throw new CompileException('Did you mean <form n:name=...> ?');
		}
		$name = $node->tokenizer->fetchWord();
		if ($name === FALSE) {
			throw new CompileException("Missing form name in {{$node->name}}.");
		}
		$node->tokenizer->reset();
		return $writer->write(
			'echo Pipas\Forms\Latte\Runtime::renderFormBegin($form = $_form = '
			. ($name[0] === '$' ? 'is_object(%node.word) ? %node.word : ' : '')
			. '$_control[%node.word], %node.array)'
		);
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