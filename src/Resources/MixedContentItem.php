<?php

namespace OhDear\PhpSdk\Resources;

class MixedContentItem extends ApiResource
{
    /**
     * The name of the element that was detected as mixed content.
     *
     * @var string
     */
    public $elementName;

    /**
     * The url of the detected mixed content.
     *
     * @var string
     */
    public $mixedContentUrl;

    /**
     * The url where the mixed content was found.
     *
     * @var string
     */
    public $foundOnUrl;

    public function __construct(array $attributes, $ohDear = null)
    {
        parent::__construct($attributes, $ohDear);
    }
}
