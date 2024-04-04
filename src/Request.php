<?php

namespace DeploymentHawk;

class Request
{
    protected array $request;

    public function __construct(array $request)
    {
        $this->request = $request;
    }

    public function url(): string
    {
        return $this->request['request']['url'];
    }

    public function totalTime(int $precision = 2): float
    {
        return round($this->request['time'], $precision);
    }

    public function blockedTiming(int $precision = 2): ?float
    {
        return $this->request['timings']['blocked'] === -1
            ? null
            : round($this->request['timings']['blocked'], $precision);
    }

    public function dnsTiming(int $precision = 2): ?float
    {
        return $this->request['timings']['dns'] === -1
            ? null
            : round($this->request['timings']['dns'], $precision);
    }

    public function connectTiming(int $precision = 2): ?float
    {
        return $this->request['timings']['connect'] === -1
            ? null
            : round($this->request['timings']['connect'], $precision);
    }

    public function sslTiming(int $precision = 2): ?float
    {
        return $this->request['timings']['ssl'] === -1
            ? null
            : round($this->request['timings']['ssl'], $precision);
    }

    public function sendTiming(int $precision = 2): float
    {
        return round($this->request['timings']['send'], $precision);
    }

    public function waitTiming(int $precision = 2): float
    {
        return round($this->request['timings']['wait'], $precision);
    }

    public function receiveTiming(int $precision = 2): float
    {
        return round($this->request['timings']['receive'], $precision);
    }
}
