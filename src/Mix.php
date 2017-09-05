<?php
/**
 * Craft Mix
 *
 * @author	  	DelaneyMethod
 * @copyright 	Copyright (c) 2017
 * @link	  	http://www.delaneymethod.com/
 */

namespace delaneymethod\mix;

use delaneymethod\mix\models\Settings;
use delaneymethod\mix\twigextensions\MixTwigExtension;
use delaneymethod\mix\variables\MixVariable;

use Craft;
use craft\base\Plugin;

class Mix extends Plugin
{
	/**
	 * @var Mix
	 */
	public static $plugin;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();
		
		self::$plugin = $this;

		Craft::$app->view->twig->addExtension(new MixTwigExtension());

		Craft::info('Craft Mix plugin loaded', __METHOD__);
	}

	/**
	 * @inheritdoc
	 */
	public function defineTemplateComponent()
	{
		return MixVariable::class;
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
			'mix/settings',
			['settings' => $this->getSettings()]
		);
	}
}
