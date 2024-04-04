<?php

namespace DeploymentHawk;

class Entry
{
    protected array $entry;

    public function __construct(array $entry)
    {
        $this->entry = $entry;
    }

    public function time(int $precision = 2): float
    {
        return round($this->entry['time'], $precision);
    }

    public function blockedTiming(int $precision = 2): ?float
    {
        return $this->entry['timings']['blocked'] === -1
            ? null
            : round($this->entry['timings']['blocked'], $precision);
    }

    public function dnsTiming(int $precision = 2): ?float
    {
        return $this->entry['timings']['dns'] === -1
            ? null
            : round($this->entry['timings']['dns'], $precision);
    }

    public function connectTiming(int $precision = 2): ?float
    {
        return $this->entry['timings']['connect'] === -1
            ? null
            : round($this->entry['timings']['connect'], $precision);
    }

    public function sslTiming(int $precision = 2): ?float
    {
        return $this->entry['timings']['ssl'] === -1
            ? null
            : round($this->entry['timings']['ssl'], $precision);
    }

    public function sendTiming(int $precision = 2): float
    {
        return round($this->entry['timings']['send'], $precision);
    }

    public function waitTiming(int $precision = 2): float
    {
        return round($this->entry['timings']['wait'], $precision);
    }

    public function receiveTiming(int $precision = 2): float
    {
        return round($this->entry['timings']['receive'], $precision);
    }
}