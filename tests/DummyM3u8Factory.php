<?php

/*
 * This file is part of the PhpM3u8 package.
 *
 * (c) Chrisyue <http://chrisyue.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chrisyue\PhpM3u8\tests;

use Chrisyue\PhpM3u8\M3u8;
use Chrisyue\PhpM3u8\Segment;

class DummyM3u8Factory
{
    public static function createM3u8($version = 3)
    {
        $m3u8 = new M3u8();
        $m3u8->getVersionTag()->setVersion($version);
        $m3u8->getMediaSequenceTag()->setMediaSequence(33);
        $m3u8->getDiscontinuitySequenceTag()->setDiscontinuitySequence(3);
        $m3u8->getTargetDurationTag()->setTargetDuration(12);
        $m3u8->getAllowCacheTag()->setAllowCache(false);
        $m3u8->getEndlistTag()->setEndless(true);

        $segment = new Segment($version);
        $segment->getExtinfTag()->setDuration(12)->setTitle('hello world');
        $segment->getByteRangeTag()->setLength(10000)->setOffset(100);
        $segment->getUri()->setUri('stream33.ts');
        $m3u8->getSegments()->add($segment);

        $segment = new Segment($version);
        $segment->getExtinfTag()->setDuration(10);
        $segment->getDiscontinuityTag()->setDiscontinuity(true);
        $segment->getUri()->setUri('video01.ts');
        $m3u8->getSegments()->add($segment);

        return $m3u8;
    }

    public static function createM3u8Content($version = 3)
    {
        if ($version < 3) {
            return <<<'M3U8'
#EXTM3U
#EXT-X-VERSION:2
#EXT-X-ALLOW-CACHE:NO
#EXT-X-TARGETDURATION:12
#EXT-X-MEDIA-SEQUENCE:33
#EXT-X-DISCONTINUITY-SEQUENCE:3
#EXTINF:12,hello world
#EXT-X-BYTERANGE:10000@100
stream33.ts
#EXTINF:10,
#EXT-X-DISCONTINUITY
video01.ts
M3U8;
        }

        return <<<'M3U8'
#EXTM3U
#EXT-X-VERSION:3
#EXT-X-ALLOW-CACHE:NO
#EXT-X-TARGETDURATION:12
#EXT-X-MEDIA-SEQUENCE:33
#EXT-X-DISCONTINUITY-SEQUENCE:3
#EXTINF:12.000,hello world
#EXT-X-BYTERANGE:10000@100
stream33.ts
#EXTINF:10.000,
#EXT-X-DISCONTINUITY
video01.ts
M3U8;
    }
}
