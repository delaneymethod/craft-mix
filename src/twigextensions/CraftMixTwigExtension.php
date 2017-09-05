<?php
/**
 * Craft Mix
 *
 * @author 		DelaneyMethod
 * @copyright 	Copyright (c) 2017
 * @link	  	http://www.delaneymethod.com/
 */

namespace delaneymethod\craftmix\twigextensions;

use delaneymethod\craftmix\CraftMix;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class CraftMixTwigExtension extends Twig_Extension
{
	/**
	 * @inheritdoc
	 */
	public function getName()
	{
		return 'Craft Mix';
	}

	/**
	 * @inheritdoc
	 */
	public function getFilters()
	{
		return [
			new Twig_SimpleFilter('mix', [$this, 'craftMix']),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function getFunctions()
	{
		return [
			new Twig_SimpleFunction('mix', [$this, 'craftMix']),
		];
	}

	/**
	 * Returns versioned file or the entire tag.
	 *
	 * @param	string		$file
	 * @param	bool	 	$tag 		(optional)
	 * @param	bool	 	$inline 	(optional)
	 * @return string
	 */
	public function craftMix($file, $tag = false, $inline = false)
	{
		if ($tag) {
			return CraftMix::$plugin->craftmix->withTag($file, $inline);
		}

		return CraftMix::$plugin->craftmix->version($file);
	}
}
