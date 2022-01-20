<?php
/**
 * Craft Mix
 *
 * @author      DelaneyMethod
 * @copyright   Copyright (c) 2017
 * @link        http://www.delaneymethod.com/
 */

namespace delaneymethod\craftMix\models;

use craft\base\Model;

class Settings extends Model
{
	/**
	 * Path to the public directory.
	 *
	 * @var string
	 */
	public $publicPath = 'web';

	/**
	 * Path to the asset directory.
	 *
	 * @var string
	 */
	public $assetPath = 'assets';

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['publicPath', 'assetPath'], 'required'],
			[['publicPath', 'assetPath'], 'string'],
		];
	}
}
