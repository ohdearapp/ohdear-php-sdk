<?php

namespace OhDear\PhpSdk\Resources;

class Resource
{
    /** @var array */
    public $attributes = [];

    /** @var \OhDear\PhpSdk\OhDear */
    protected $ohDear;

    /**
     * @param  array $attributes
     * @param  \OhDear\PhpSdk\OhDear $ohDear
     */
    public function __construct(array $attributes, $ohDear = null)
    {
        $this->attributes = $attributes;

        $this->ohDear = $ohDear;

        $this->fill();
    }

    protected function fill()
    {
        foreach ($this->attributes as $key => $value) {
            $key = $this->camelCase($key);

            $this->{$key} = $value;
        }
    }

    protected function camelCase(string $key)
    {
        $parts = explode('_', $key);

        foreach ($parts as $i => $part) {
            if ($i !== 0) {
                $parts[$i] = ucfirst($part);
            }
        }

        return str_replace(' ', '', implode(' ', $parts));
    }
}
