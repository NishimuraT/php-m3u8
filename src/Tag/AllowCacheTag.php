<?php

/*
 * This file is part of the PhpM3u8 package.
 *
 * (c) Chrisyue <http://chrisyue.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chrisyue\PhpM3u8\Tag;

class AllowCacheTag extends AbstractHeadTag
{
    private $allowCache = false;

    const TAG_IDENTIFIER = '#EXT-X-ALLOW-CACHE';

    public function setAllowCache($allowCache)
    {
        $this->allowCache = $allowCache;

        return $this;
    }

    public function getAllowCache()
    {
        return $this->allowCache;
    }

    protected function read($line)
    {
        preg_match('/^#EXT-X-ALLOW-CACHE:(.+)/', $line, $matches);

        $this->allowCache = $matches[1] == 'YES';
    }

    public function dump()
    {
        return sprintf('%s:%s', self::TAG_IDENTIFIER, $this->allowCache ? 'YES' : 'NO');
    }
}
