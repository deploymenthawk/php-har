<?php

namespace DeploymentHawk;

use Illuminate\Support\Collection;
use JsonException;

class Har
{
    protected array $har;

    protected Collection $entries;

    /**
     * @throws JsonException
     */
    public function __construct(array|string $har)
    {
        if (is_string($har)) {
            $har = json_decode($har, true, 512, JSON_THROW_ON_ERROR);
        }

        $this->har = $har;
    }

    public function entries(): Collection
    {
        if (empty($this->entries)) {
            $this->entries = (new Collection($this->har['log']['entries']))->map(function ($entry) {
                return new Entry($entry);
            });
        }

        return $this->entries;
    }

    public function totalRequests(): int
    {
        return $this->entries()->count();
    }

    public function onContentLoadTiming(int $precision = 2): ?float
    {
        return empty($this->har['log']['pages'][0]['pageTimings']['onContentLoad'])
            ? null
            : round($this->har['log']['pages'][0]['pageTimings']['onContentLoad'], $precision);
    }

    public function onLoadTiming(int $precision = 2): ?float
    {
        return empty($this->har['log']['pages'][0]['pageTimings']['onLoad'])
            ? null
            : round($this->har['log']['pages'][0]['pageTimings']['onLoad'], $precision);
    }
}