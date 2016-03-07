<?php


namespace App;

use Nette\Application\UI\Form;
use Tracy\Dumper;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class FormPresenter extends BasePresenter
{

	protected function createComponentDemoForm()
	{
		$form = $this->formFactory->createBootstrap();
		$form->addTextOutput("fndjfdskf");
		$form->addDate("date", "Date select")
			->setDefaultValue(new \DateTime());
		$form->addDateTime("datetime", "Datetime select")
			->setDefaultValue(new \DateTime());
		$form->addDateTime("datetime2", "Required datetime")
			->setRequired();
		$form->addSelectCountry("country", "Country")
			->setPrompt("Vyber")
			->setRequired();
		$form->addSelectLocale("locale", "Locale");

		$form->addTags("tags", "Tags")
			->setDefaultValue(array("first", "second"));
		$form->addUpload("upload", "File upload");

		$form->addSubmit("submit");
		$form->onSubmit[] = function () {
			$this->redrawControl();
		};
		$form->onSuccess[] = function (Form $form) {
			$this->flashMessage(Dumper::toHtml($form->values));
		};
		return $form;
	}
}