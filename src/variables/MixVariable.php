<?php
/**
 * Craft Mix
 *
 * @author	  	DelaneyMethod
 * @copyright 	Copyright (c) 2017
 * @link	  	http://www.delaneymethod.com/
 */

namespace delaneymethod\mix\variables;

use delaneymethod\mix\Mix;

class MixVariable
{
	/**
	 * Find the files version.
	 *
	 * @param  string  $file
	 * @return string
	 */
	public function version($file)
	{
		return Mix::$plugin->mix->version($file);
	}

	/**
	 * Returns the files version with the appropriate tag.
	 *
	 * @param  string  	$file
	 * @param  bool	 	$inline  (optional)
	 * @return string
	 */
	public function withTag($file, $inline = false)
	{
		return Mix::$plugin->mix->withTag($file, $inline);
	}
}
