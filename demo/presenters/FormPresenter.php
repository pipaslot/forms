<?php


namespace App;

use Nette\Application\UI\Form;
use Tracy\Dumper;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class FormPresenter extends BasePresenter
{

	protected function createComponentDefaultForm()
	{
		return $this->applyControls($this->formFactory->create());
	}

	protected function createComponentBootstrapForm()
	{
		return $this->applyControls($this->formFactory->createBootstrap());
	}

	protected function createComponentBootstrapInlineForm()
	{
		return $this->applyControls($this->formFactory->createBootstrapInline());
	}

	protected function createComponentBootstrapStackedForm()
	{
		return $this->applyControls($this->formFactory->createBootstrapStacked());
	}

	/**
	 * @param Form $form
	 * @return Form
	 */
	private function applyControls(Form $form)
	{
		$form->addGroup();
		$form->addTextOutput("fndjfdskf");
		$form->addDate("date", "Date select")
			->setDefaultValue(new \DateTime());
		$form->addDateTime("datetime", "Datetime select")
			->setDefaultValue(new \DateTime());
		$form->addDateTime("datetime2", "Required datetime")
			->setRequired();
		$form->addGroup("My extra group");
		$form->addSelectCountry("country", "Country")
			->setPrompt("Vyber")
			->setRequired();
		$form->addSelectLocale("locale", "Locale");

		$form->addTags("tags", "Tags")
			->setDefaultValue(array("first", "second"));
		$form->addUpload("upload", "File upload");
		$form->addUpload("uploadAjax", "AJAX File upload")
			->controlPrototype->addAttributes(array(
				"data-upload-url" => $this->link("upload!")
			));

		$form->addSubmit("submit");
		$form->onSubmit[] = function () {
			$this->redrawControl();
		};
		$form->onSuccess[] = function (Form $form) {
			$this->flashMessage(Dumper::toHtml($form->values));
		};
		return $form;
	}

	public function handleUpload()
	{
		echo 1;
		$this->terminate();
	}
}