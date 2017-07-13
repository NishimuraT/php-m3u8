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
use PHPUnit\Framework\TestCase;

class M3u8Test extends TestCase
{
    public function testRead()
    {
        $content = DummyM3u8Factory::createM3u8Content(2);
        $m3u8 = new M3u8();
        $m3u8->read($content);

        $this->assertEquals(2, $m3u8->getVersion());
        $this->assertEquals(12, $m3u8->getTargetDuration());
        $this->assertEquals(33, $m3u8->getMediaSequence());
        $this->assertEquals(false, $m3u8->getAllowCache());
        $this->assertEquals(3, $m3u8->getDiscontinuitySequence());

        $segment = $m3u8->getSegments()->offsetGet(0);
        $this->assertEquals(12, $segment->getExtinfTag()->getDuration());
        $this->assertEquals('hello world', $segment->getExtinfTag()->getTitle());
        $this->assertEquals('stream33.ts', (string) $segment->getUri());
        $this->assertEquals(10000, $segment->getByteRangeTag()->getLength());
        $this->assertEquals(100, $segment->getByteRangeTag()->getOffset());
        $this->assertFalse($segment->isDiscontinuity());

        $segment = $m3u8->getSegments()->offsetGet(1);
        $this->assertEquals(10, $segment->getExtinfTag()->getDuration());
        $this->assertEquals('video01.ts', (string) $segment->getUri());
        $this->assertTrue($segment->isDiscontinuity());

        $this->assertEquals(22, $m3u8->getDuration());
    }

    public function testDump()
    {
        $m3u8 = DummyM3u8Factory::createM3u8(3);

        $this->assertEquals(DummyM3u8Factory::createM3u8Content(3), $m3u8->dump());
    }
}
