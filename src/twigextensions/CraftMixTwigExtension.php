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
	public function getName(): string
	{
		return 'Craft Mix';
	}

	/**
	 * @return TwigFilter[]
	 */
	public function getFilters(): array
	{
		return [
			new TwigFilter('mix', [$this, 'mix']),
		];
	}

	/**
	 * @return TwigFunction[]
	 */
	public function getFunctions(): array
	{
		return [
			new TwigFunction('mix', [$this, 'mix']),
		];
	}

	/**
	 * Returns versioned file or the entire tag.
	 *
	 * @param string $file
	 * @param bool $tag
	 * @param bool $inline
	 * @return string
	 */
	public function mix(string $file, bool $tag = false, bool $inline = false): string
	{
		if ($tag) {
			return CraftMix::$plugin->craftMix->withTag($file, $inline);
		}

		return CraftMix::$plugin->craftMix->version($file);
	}
}
