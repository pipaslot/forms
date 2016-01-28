<?php


namespace App;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class FormPresenter extends BasePresenter
{

	protected function createComponentDemoForm()
	{
		$form = $this->formFactory->createBootstrap();
		$form->addTextOutput("fndjfdskf");
		$form->addCountry("country", "Country")
			->setPrompt("Vyber")
			->setRequired();
		$form->addDate("date", "Date select")
			->setDefaultValue(new \DateTime());
		$form->addDateTime("datetime", "Datetime select")
			->setDefaultValue(new \DateTime());
		$form->addDateTime("datetime2", "Required datetime")
			->setRequired();

		$form->addSubmit("submit");
		$form->onSubmit[] = function () {
			$this->redrawControl();
		};
		$form->onSuccess[] = function () {
			$this->redrawControl();
		};
		return $form;
	}
}