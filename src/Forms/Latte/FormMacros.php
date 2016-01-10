<?php

namespace Pipas\Forms\Latte;

use Latte\CompileException;
use Latte\Compiler;
use Latte\MacroNode;
use Latte\PhpWriter;
use Nette\Bridges\FormsLatte;

/**
 * Override default Form macros
 * @author Petr Štipek <p.stipek@email.cz>
 */
class FormMacros extends FormsLatte\FormMacros
{
	public static function install(Compiler $compiler)
	{
		$me = new static($compiler);
		$me->addMacro('form', array($me, 'macroForm'), 'echo Pipas\Forms\Latte\Runtime::renderFormEnd($_form)');
		$me->addMacro('formContainer', array($me, 'macroFormContainer'), '$formContainer = $_form = array_pop($_formStack)');
		$me->addMacro('label', array($me, 'macroLabel'), array($me, 'macroLabelEnd'));
		$me->addMacro('input', array($me, 'macroInput'), NULL, array($me, 'macroInputAttr'));
		$me->addMacro('name', array($me, 'macroName'), array($me, 'macroNameEnd'), array($me, 'macroNameAttr'));
		$me->addMacro('inputError', array($me, 'macroInputError'));
	}

	/**
	 * {form ...}
	 * @param MacroNode $node
	 * @param PhpWriter $writer
	 * @return string
	 * @throws CompileException
	 */
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
}