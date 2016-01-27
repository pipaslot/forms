<?php
namespace Pipas\Forms\DI;

use Nette\DI\CompilerExtension;
use Nette\DI\ServiceDefinition;
use Nette\Localization\ITranslator;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Method;
use Pipas\Forms\Controls\CountrySelectBox;
use Pipas\Forms\Controls\TextOutput;
use Pipas\Forms\FormFactory;
use Pipas\Forms\Latte\FormMacros;

/**
 * Registers helper methods 'addTextOutput'
 * and corresponding Latte macros for convenient manual rendering
 *
 * @author Petr Štipek
 */
class FormExtension extends CompilerExtension
{
	private $countryCodes = array('af', 'ax', 'al', 'dz', 'as', 'ad', 'ao', 'ai', 'aq', 'ag', 'ar', 'am', 'aw', 'ac', 'au', 'at', 'az', 'bs', 'bh', 'bd', 'bb', 'by', 'be', 'bz', 'bj', 'bm', 'bt', 'bo', 'ba', 'bw', 'br', 'io', 'vg', 'bn', 'bg', 'bf', 'bi', 'kh', 'cm', 'ca', 'ic', 'cv', 'bq', 'ky', 'cf', 'td', 'cl', 'cn', 'cx', 'cc', 'co', 'km', 'cg', 'cd', 'ck', 'cr', 'ci', 'hr', 'cu', 'ea', 'cw', 'cy', 'cz', 'dk', 'dg', 'dj', 'dm', 'do', 'ec', 'eg', 'sv', 'gq', 'er', 'ee', 'et', 'fk', 'fo', 'fj', 'fi', 'fr', 'pf', 'tf', 'ga', 'gm', 'ge', 'de', 'gh', 'gi', 'gr', 'gl', 'gd', 'gp', 'gu', 'gt', 'gg', 'gn', 'gw', 'gy', 'ht', 'hn', 'hk', 'hu', 'is', 'in', 'id', 'ir', 'iq', 'ie', 'im', 'il', 'it', 'jm', 'jp', 'je', 'jo', 'kz', 'ke', 'ki', 'xk', 'kw', 'kg', 'la', 'lv', 'lb', 'ls', 'lr', 'ly', 'li', 'lt', 'lu', 'mo', 'mk', 'mg', 'mw', 'my', 'mv', 'ml', 'mt', 'mh', 'mq', 'mr', 'mu', 'yt', 'mx', 'fm', 'md', 'mc', 'mn', 'me', 'ms', 'ma', 'mz', 'mm', 'na', 'nr', 'np', 'nl', 'nc', 'nz', 'ni', 'ne', 'ng', 'nu', 'nf', 'kp', 'mp', 'no', 'om', 'pk', 'pw', 'ps', 'pa', 'pg', 'py', 'pe', 'ph', 'pn', 'pl', 'pt', 'pr', 'qa', 're', 'ro', 'ru', 'rw', 'bl', 'sh', 'kn', 'lc', 'mf', 'pm', 'vc', 'ws', 'sm', 'st', 'sa', 'sn', 'rs', 'sc', 'sl', 'sg', 'sx', 'sk', 'si', 'sb', 'so', 'za', 'gs', 'kr', 'ss', 'es', 'lk', 'sd', 'sr', 'sj', 'sz', 'se', 'ch', 'sy', 'tw', 'tj', 'tz', 'th', 'tl', 'tg', 'tk', 'to', 'tt', 'ta', 'tn', 'tr', 'tm', 'tc', 'tv', 'um', 'vi', 'ug', 'ua', 'ae', 'gb', 'us', 'uy', 'uz', 'vu', 'va', 've', 'vn', 'wf', 'eh', 'ye', 'zm', 'zw', 'gf');
	public $defaults = array(
		'language' => array(),
		'country' => array(
			"prefix" => "country.",
			"codes" => array()
		)
	);

	public function loadConfiguration()
	{
		$container = $this->getContainerBuilder();
		//Register form factory
		$container->addDefinition($this->prefix('formFactory'))
			->setClass(FormFactory::class);

		//setup macros
		$latteFactory = $this->getLatteFactory();
		$latteFactory->addSetup('?->onCompile[] = function($engine) { ' . FormMacros::class . '::install($engine->getCompiler()); }', array('@self'));
	}

	public function beforeCompile()
	{
		$container = $this->getContainerBuilder();
		$factory = $container->getDefinition($this->prefix('formFactory'));
		$translators = $container->findByType(ITranslator::class);

		if (count($translators) > 0) {
			$factory->addSetup('$service->setTranslator(?)', $translators);
		}
	}

	public function afterCompile(ClassType $class)
	{
		$config = $this->validateConfig($this->defaults);

		$methods = $class->getMethods();
		$initialize = $methods['initialize'];
		$initialize->addBody(TextOutput::class . '::register();');
		$this->registerCountrySelectBox($initialize, $config['country']);

	}

	/**
	 * @return ServiceDefinition
	 */
	private function getLatteFactory()
	{
		$builder = $this->getContainerBuilder();
		return $builder->hasDefinition('nette.latteFactory')
			? $builder->getDefinition('nette.latteFactory')
			: $builder->getDefinition('nette.latte');
	}

	/**
	 * @param Method $initialize
	 * @param $config
	 */
	private function registerCountrySelectBox(Method $initialize, $config)
	{
		$codes = count($config['codes']) == 0 ? $this->countryCodes : (array)$config['codes'];
		$countries = array();
		foreach ($codes as $code) {
			$lowercase = strtolower($code);
			$countries[$lowercase] = $config['prefix'] . $lowercase;
		}

		$initialize->addBody(CountrySelectBox::class . '::$countries = ?;', array($countries));
		$initialize->addBody(CountrySelectBox::class . '::register();');
	}

}