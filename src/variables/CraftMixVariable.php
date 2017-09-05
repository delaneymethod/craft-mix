<?php
/**
 * Craft Mix
 *
 * @author    DelaneyMethod
 * @copyright Copyright (c) 2017
 * @link      http://www.delaneymethod.com/
 */

namespace delaneymethod\craft-mix\variables;

use delaneymethod\craft-mix\CraftMix;

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
        return CraftMix::$plugin->craftMix->version($file);
    }

    /**
     * Returns the files version with the appropriate tag.
     *
     * @param  string  $file
     * @param  bool  $inline  (optional)
     * @return string
     */
    public function withTag($file, $inline = false)
    {
        return CraftMix::$plugin->craftMix->withTag($file, $inline);
    }
}
