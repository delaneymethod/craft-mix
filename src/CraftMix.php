<?php
/**
 * Craft Mix
 *
 * @author      DelaneyMethod
 * @copyright   Copyright (c) 2017
 * @link        http://www.delaneymethod.com/
 */

namespace delaneymethod\craftMix;

use Craft;
use craft\base\Model;
use craft\base\Plugin;
use yii\base\Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use delaneymethod\craftMix\models\Settings;
use delaneymethod\craftMix\variables\CraftMixVariable;
use delaneymethod\craftMix\twigextensions\CraftMixTwigExtension;

class CraftMix extends Plugin
{
	/**
	 * @var CraftMix
	 */
	public static CraftMix $plugin;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		self::$plugin = $this;

		Craft::$app->view->registerTwigExtension(new CraftMixTwigExtension());

		Craft::info('Craft Mix plugin loaded', __METHOD__);
	}

	/**
	 * @return string
	 */
	public function defineTemplateComponent(): string
	{
		return CraftMixVariable::class;
	}

	/**
	 * @return Model|null
	 */
	protected function createSettingsModel(): ?Model
	{
		return new Settings();
	}

	/**
	 * @return string|null
	 * @throws Exception
	 * @throws LoaderError
	 * @throws RuntimeError
	 * @throws SyntaxError
	 */
	protected function settingsHtml(): ?string
	{
		return Craft::$app->view->renderTemplate('craft-mix/settings', [
			'settings' => $this->getSettings()
		]);
	}
}
