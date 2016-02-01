<?php


namespace Pipas\Forms\Controls;

use Nette\Application\IPresenter;
use Nette\Forms\Container;
use Nette\Forms\Controls\TextInput;
use Nette\Forms\Validator;
use Nette\Utils\Html;

/**
 * Require JqueryUi library
 * @author Petr Štipek <p.stipek@email.cz>
 */
class TagControl extends TextInput
{
	/** @var bool */
	private $usePlaceholder = TRUE;
	const VALID = ":tags";

	/**
	 * @param string $label
	 * @param string $maxLength
	 */
	public function __construct($label = NULL, $maxLength = NULL)
	{
		parent::__construct($label, $maxLength);
		$this->monitor("Nette\Application\IPresenter");
	}

	/**
	 * @param bool|FALSE $value
	 * @return TagControl
	 */
	public function usePlaceholder($value = FALSE)
	{
		$this->usePlaceholder = $value;
		return $this;
	}

	/**
	 * Changes control"s HTML attribute.
	 *
	 * @param  string $name
	 * @param  mixed $value
	 * @return self
	 */
	public function setAttribute($name, $value = TRUE)
	{
		if ($name === "placeholder") {
			$this->usePlaceholder = FALSE;
		}
		return parent::setAttribute($name, $value);
	}

	private function createPlaceholder()
	{
		if ($this->usePlaceholder === FALSE) {
			return;
		}
		$message = isset(Validator::$messages[self::VALID]) ? Validator::$messages[self::VALID] : "For the distribution of words please use comma.";
		if ($this->getTranslator()) {
			$message = $this->getTranslator()->translate($message);
		}
		$this->setAttribute("placeholder", $message);
	}

	/**
	 * This method will be called when the component becomes attached to Form.
	 *
	 * @param  Nette\ComponentModel\IComponent
	 * @return void
	 */
	protected function attached($form)
	{
		parent::attached($form);
		if ($form instanceof IPresenter) {
			$this->createPlaceholder();
		}
	}

	/**
	 * @return array
	 */
	public function getValue()
	{
		$value = parent::getValue();
		if (!$value) {
			return NULL;
		} else if (is_array($value)) {
			return $value;
		}
		return array_map(function ($value) {
			return trim($value);
		}, explode(",", $value));
	}

	/**
	 * @return Html
	 */
	public function getControl()
	{

		$control = parent::getControl();
		$control->value = implode(",", (array)$this->getValue());
		$control->class[] = "tag-input";
		$control->style[] = "display:none";
		$control->addAttributes(array("data-role" => "tagsinput"));

		$container = Html::el("div");
		$container->add($control);
		return $container;
	}

	/**
	 * @param mixed $value
	 * @return $this
	 */
	public function setValue($value)
	{
		$this->rawValue = $this->value = $value;
		return $this;
	}

	/**
	 * Adds custom method of generic select box to Nette\Forms\Container
	 */
	public static function register()
	{
		Container::extensionMethod("addTags", function (Container $container, $name, $label = NULL) {
			return $container[$name] = new TagControl($label);
		});
	}
}