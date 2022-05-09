<?php
/**
 * Craft Mix
 *
 * @author      DelaneyMethod
 * @copyright   Copyright (c) 2017
 * @link        http://www.delaneymethod.com/
 */

namespace delaneymethod\craftMix\variables;

use delaneymethod\craftMix\CraftMix;

class CraftMixVariable
{
	/**
	 * Find the files version.
	 *
	 * @param string $file
	 * @return string
	 */
	public function version(string $file): string
	{
		return CraftMix::$plugin->craftMix->version($file);
	}

	/**
	 * Returns the files version with the appropriate tag.
	 *
	 * @param string $file
	 * @param bool $inline
	 * @return string
	 */
	public function withTag(string $file, bool $inline = false): string
	{
		return CraftMix::$plugin->craftMix->withTag($file, $inline);
	}
}
