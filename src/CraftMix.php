<?php
/**
 * Craft Mix
 *
 * @author    DelaneyMethod
 * @copyright Copyright (c) 2017
 * @link      http://www.delaneymethod.com/
 */

namespace delaneymethod\craft-mix;

use delaneymethod\craft-mix\models\Settings;
use delaneymethod\craft-mix\twigextensions\CraftMixTwigExtension;
use delaneymethod\craft-mix\variables\CraftMixVariable;

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
    protected function settingsHtml(): string
    {
        return Craft::$app->view->renderTemplate(
            'craft-mix/settings',
            ['settings' => $this->getSettings()]
        );
    }
}
