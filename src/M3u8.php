<?php

/*
 * This file is part of the PhpM3u8 package.
 *
 * (c) Chrisyue <http://chrisyue.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Chrisyue\PhpM3u8;

class M3u8 extends AbstractContainer
{
    private $m3uTag;
    private $versionTag;
    private $targetDurationTag;
    private $mediaSequenceTag;
    private $allowCacheTag;
    private $discontinuitySequenceTag;
    private $keyTag;
    private $segments;
    private $endlistTag;

    public function __construct()
    {
        $this->m3uTag = new Tag\M3uTag();
        $this->versionTag = new Tag\VersionTag();
        $this->targetDurationTag = new Tag\TargetDurationTag();
        $this->mediaSequenceTag = new Tag\MediaSequenceTag();
        $this->allowCacheTag = new Tag\AllowCacheTag();
        $this->discontinuitySequenceTag = new Tag\DiscontinuitySequenceTag();
        $this->keyTag = new Tag\KeyTag();
        $this->segments = new Segments($this);
        $this->endlistTag = new Tag\EndlistTag();
    }

    public function read($string)
    {
        $lines = $this->split($string);

        $this->readLines($lines);
    }

    public function getVersionTag()
    {
        return $this->versionTag;
    }

    public function getVersion()
    {
        return $this->versionTag->getVersion();
    }

    public function getTargetDurationTag()
    {
        return $this->targetDurationTag;
    }

    public function getTargetDuration()
    {
        return $this->targetDurationTag->getTargetDuration();
    }

    public function getMediaSequenceTag()
    {
        return $this->mediaSequenceTag;
    }

    public function getMediaSequence()
    {
        return $this->mediaSequenceTag->getMediaSequence();
    }

    public function getAllowCacheTag()
    {
        return $this->allowCacheTag;
    }

    public function getAllowCache()
    {
        return $this->allowCacheTag->getAllowCache();
    }

    public function getDiscontinuitySequenceTag()
    {
        return $this->discontinuitySequenceTag;
    }

    public function getDiscontinuitySequence()
    {
        return $this->discontinuitySequenceTag->getDiscontinuitySequence();
    }

    public function getKeyTag()
    {
        return $this->keyTag;
    }

    /**
     * @return Chrisyue\PhpM3u8\Segments
     */
    public function getSegments()
    {
        return $this->segments;
    }

    public function getEndlistTag()
    {
        return $this->endlistTag;
    }

    public function isEndless()
    {
        return $this->endlistTag->isEndless();
    }

    public function getDuration()
    {
        return $this->segments->getDuration();
    }

    protected function getComponents()
    {
        return array(
            $this->m3uTag,
            $this->versionTag,
            $this->allowCacheTag,
            $this->targetDurationTag,
            $this->mediaSequenceTag,
            $this->discontinuitySequenceTag,
            $this->keyTag,
            $this->segments,
            $this->endlistTag,
        );
    }

    private function split($string)
    {
        $lines = explode("\n", $string);
        $lines = array_map('trim', $lines);

        return array_filter($lines);
    }
}
