<?php
/**
 * Craft Mix
 *
 * @author      DelaneyMethod
 * @copyright   Copyright (c) 2017
 * @link        http://www.delaneymethod.com/
 */

namespace delaneymethod\craftMix\twigextensions;

use delaneymethod\craftMix\CraftMix;

use Twig\TwigFilter;
use TWig\TwigFunction;
use Twig\Extension\AbstractExtension;

class CraftMixTwigExtension extends AbstractExtension
{
	/**
	 * @return string
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
			new TwigFilter('mix', [$this, 'mix']),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function getFunctions()
	{
		return [
			new TwigFunction('mix', [$this, 'mix']),
		];
	}

	/**
	 * Returns versioned file or the entire tag.
	 *
	 * @param	string    $file
	 * @param	bool	 	  $tag      (optional)
	 * @param	bool	 	  $inline   (optional)
	 * @return string
	 */
	public function mix($file, $tag = false, $inline = false)
	{
		if ($tag) {
			return CraftMix::$plugin->craftMix->withTag($file, $inline);
		}

		return CraftMix::$plugin->craftMix->version($file);
	}
}
