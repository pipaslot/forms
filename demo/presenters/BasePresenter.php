<?php


namespace App;

use Nette\Application\UI\Presenter;
use Pipas\Forms\FormFactory;

/**
 * @author Petr Štipek <p.stipek@email.cz>
 */
class BasePresenter extends Presenter
{
	/** @persistent */
	public $locale;
	/** @var  FormFactory @inject */
	public $formFactory;
	private $redrawSnippets = array();

	/**
	 * @param $name
	 * @param null $duration Call sleep for selected time
	 */
	public function handleInvalidate($name, $duration = null)
	{
		$this->redrawControl($name);
		$this->redrawSnippets[$name] = $name;
		if ($duration) sleep((int)$duration);
	}

	protected function beforeRender()
	{
		parent::beforeRender();
		$this->template->redrawSnippets = $this->redrawSnippets;
		$this->template->locale = $this->locale;
	}

}