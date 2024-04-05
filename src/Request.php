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

    public function time(int $precision = 2): float
    {
        return round($this->request['time'], $precision);
    }

    public function size(): int
    {
        return $this->request['response']['_transferSize'];
    }

    public function uncompressedSize(): int
    {
        return $this->request['response']['content']['size'];
    }

    public function timings(int $precision = 2): array
    {
        return [
            'blocked' => $this->blockedTiming($precision),
            'dns' => $this->dnsTiming($precision),
            'ssl' => $this->sslTiming($precision),
            'connect' => $this->connectTiming($precision),
            'send' => $this->sendTiming($precision),
            'wait' => $this->waitTiming($precision),
            'receive' => $this->sendTiming($precision),
        ];
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
