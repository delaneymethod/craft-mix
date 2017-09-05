<?php
/**
 * Craft Mix
 *
 * @author	  	DelaneyMethod
 * @copyright 	Copyright (c) 2017
 * @link	  	http://www.delaneymethod.com/
 */

namespace delaneymethod\craftmix;

use delaneymethod\craftmix\models\Settings;
use delaneymethod\craftmix\twigextensions\CraftMixTwigExtension;
use delaneymethod\craftmix\variables\CraftMixVariable;

use Craft;
use craft\base\Plugin;

class CraftMix extends Plugin
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

		Craft::$app->view->twig->addExtension(new CraftMixTwigExtension());

		Craft::info('Craft Mix plugin loaded', __METHOD__);
	}

	/**
	 * @inheritdoc
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
	protected function settingsHtml() : string
	{
		return Craft::$app->view->renderTemplate(
			'craftmix/settings',
			['settings' => $this->getSettings()]
		);
	}
}
