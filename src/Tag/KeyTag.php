<?php

namespace Chrisyue\PhpM3u8\Tag;

class KeyTag extends AbstractHeadTag
{
    private $method = 'AES-128';
    private $uri = '';

    const TAG_IDENTIFIER = '#EXT-X-KEY';

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function setUri($uri)
    {
        $this->uri = $uri;
    }

    protected function read($line)
    {
        preg_match('/^#EXT-X-KEY:METHOD\=(.+),URI\=\"(.+)\"/', $line, $matches);

        $this->method = $matches[1];
        $this->uri = $matches[2];
    }

    public function dump()
    {
        return sprintf('%s:METHOD=%s,URI="%s"', self::TAG_IDENTIFIER, $this->method, $this->uri);
    }
}