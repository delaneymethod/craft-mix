<?php
/**
 * Craft Mix
 *
 * @author	  	DelaneyMethod
 * @copyright 	Copyright (c) 2017
 * @link	  	http://www.delaneymethod.com/
 */

namespace delaneymethod\craftmix\variables;

use delaneymethod\craftmix\CraftMix;

class CraftMixVariable
{
	/**
	 * Find the files version.
	 *
	 * @param  string  $file
	 * @return string
	 */
	public function version($file)
	{
		return CraftMix::$plugin->craftmix->version($file);
	}

	/**
	 * Returns the files version with the appropriate tag.
	 *
	 * @param  string  $file
	 * @param  bool	 $inline  (optional)
	 * @return string
	 */
	public function withTag($file, $inline = false)
	{
		return CraftMix::$plugin->craftmix->withTag($file, $inline);
	}
}
