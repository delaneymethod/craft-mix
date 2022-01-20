<?php
/**
 * Craft Mix
 *
 * @author      DelaneyMethod
 * @copyright   Copyright (c) 2017
 * @link        http://www.delaneymethod.com/
 */

namespace delaneymethod\craftMix;

use delaneymethod\craftMix\models\Settings;
use delaneymethod\craftMix\twigextensions\CraftMixTwigExtension;
use delaneymethod\craftMix\variables\CraftMixVariable;

use Craft;
use craft\base\Plugin;

class CraftMix extends Plugin
{
	/**
	 * @var CraftMix
	 */
	public static $plugin;

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
	public function defineTemplateComponent()
	{
		return CraftMixVariable::class;
	}

	/**
	 * @inheritdoc
	 */
	protected function createSettingsModel()
	{
		return new Settings();
	}

	/**
	 * @inheritdoc
	 */
	protected function settingsHtml(): string
	{
		return Craft::$app->view->renderTemplate(
			'craft-mix/settings',
			['settings' => $this->getSettings()]
		);
	}
}
