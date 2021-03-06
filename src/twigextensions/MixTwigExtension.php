<?php
/**
 * Craft Mix
 *
 * @author 		DelaneyMethod
 * @copyright 	Copyright (c) 2017
 * @link	  	http://www.delaneymethod.com/
 */

namespace delaneymethod\mix\twigextensions;

use delaneymethod\mix\Mix;

use Twig_Extension;
use Twig_SimpleFilter;
use Twig_SimpleFunction;

class MixTwigExtension extends Twig_Extension
{
	/**
	 * @inheritdoc
	 */
	public function getName()
	{
		return 'Mix';
	}

	/**
	 * @inheritdoc
	 */
	public function getFilters()
	{
		return [
			new Twig_SimpleFilter('mix', [$this, 'mix']),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function getFunctions()
	{
		return [
			new Twig_SimpleFunction('mix', [$this, 'mix']),
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
	public function mix($file, $tag = false, $inline = false)
	{
		if ($tag) {
			return Mix::$plugin->mix->withTag($file, $inline);
		}

		return Mix::$plugin->mix->version($file);
	}
}
