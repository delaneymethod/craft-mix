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
	public string $publicPath = 'web';

	/**
	 * Path to the asset directory.
	 *
	 * @var string
	 */
	public string $assetPath = 'assets';

	/**
	 * @return array[]
	 */
	public function rules(): array
	{
		return [
			[['publicPath', 'assetPath'], 'required'],
			[['publicPath', 'assetPath'], 'string'],
		];
	}
}
