<?php

namespace Chrisyue\PhpM3u8\Tag;

class PlaylistTypeTag extends AbstractHeadTag
{
    private $isVod = true;

    const TAG_IDENTIFIER = '#EXT-X-PLAYLIST-TYPE';

    public function setIsVod($isVod)
    {
        $this->isVod = $isVod;

        return $this;
    }

    public function getIsVod()
    {
        return $this->isVod;
    }

    public function dump()
    {
        return sprintf('%s:%s', self::TAG_IDENTIFIER, $this->isVod ? 'VOD' : 'EVENT');
    }

    protected function read($line)
    {
        preg_match('/^#EXT-X-PLAYLIST-TYPE:(.+)/', $line, $matches);

        $this->isVod = $matches[1] == 'VOD';
    }
}