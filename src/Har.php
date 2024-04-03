<?php

namespace DeploymentHawk;

use JsonException;

class Har
{
    protected array $har;

    /**
     * @throws JsonException
     */
    public function __construct(array|string $har)
    {
        if (is_string($har)) {
            $har = json_decode($har, false, 512, JSON_THROW_ON_ERROR);
        }

        $this->har = $har;
    }
}