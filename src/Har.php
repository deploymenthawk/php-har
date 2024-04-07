<?php

namespace DeploymentHawk;

use Illuminate\Support\Collection;
use JsonException;

class Har
{
    protected array $har;

    protected Collection $requests;

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

    public function requests(): Collection
    {
        if (empty($this->requests)) {
            $this->requests = (new Collection($this->har['log']['entries']))->mapInto(Request::class);
        }

        return $this->requests;
    }

    public function totalRequests(): int
    {
        return $this->requests()->count();
    }

    public function totalRequestsByType(?string $type = null): array|int
    {
        if (is_null($type)) {
            return $this->requests()
                ->groupBy(fn (Request $request) => $request->type())
                ->map(fn (Collection $group) => $group->count())
                ->toArray();
        }

        return $this->requests()
            ->filter(fn (Request $request) => $request->type() === $type)
            ->count();
    }

    public function slowestRequest(): Request
    {
        return $this->requests()
            ->sortBy(fn (Request $request) => $request->time())
            ->last();
    }

    public function fastestRequest(): Request
    {
        return $this->requests()
            ->sortBy(fn (Request $request) => $request->time())
            ->first();
    }

    public function largestRequest(): Request
    {
        return $this->requests()
            ->sortBy(fn (Request $request) => $request->size())
            ->last();
    }

    public function smallestRequest(): Request
    {
        return $this->requests()
            ->sortBy(fn (Request $request) => $request->size())
            ->first();
    }

    public function largestUncompressedRequest(): Request
    {
        return $this->requests()
            ->sortBy(fn (Request $request) => $request->uncompressedSize())
            ->last();
    }

    public function smallestUncompressedRequest(): Request
    {
        return $this->requests()
            ->sortBy(fn (Request $request) => $request->uncompressedSize())
            ->first();
    }

    public function totalSize(): int
    {
        return $this->requests()
            ->sum(fn (Request $request) => $request->size());
    }

    public function totalSizeByType(?string $type = null): array|int
    {
        return is_null($type)
            ? $this->requests()
                ->groupBy(fn (Request $request) => $request->type())
                ->map(fn (Collection $group) => $group->sum(fn (Request $request) => $request->size()))
                ->toArray()
            : $this->requests()
                ->filter(fn (Request $request) => $request->type() === $type)
                ->sum(fn (Request $request) => $request->size());
    }

    public function totalUncompressedSize(): int
    {
        return $this->requests()
            ->sum(fn (Request $request) => $request->uncompressedSize());
    }

    public function totalUncompressedSizeByType(?string $type = null): array|int
    {
        return is_null($type)
            ? $this->requests()
                ->groupBy(fn (Request $request) => $request->type())
                ->map(fn (Collection $group) => $group->sum(fn (Request $request) => $request->uncompressedSize()))
                ->toArray()
            : $this->requests()
                ->filter(fn (Request $request) => $request->type() === $type)
                ->sum(fn (Request $request) => $request->uncompressedSize());
    }

    public function onContentLoadTiming(int $precision = 2): ?float
    {
        $contentLoadTiming = $this->har['log']['pages'][0]['pageTimings']['onContentLoad'] ?? null;

        return is_null($contentLoadTiming) || $contentLoadTiming === -1
            ? null
            : round($contentLoadTiming, $precision);
    }

    public function onLoadTiming(int $precision = 2): ?float
    {
        $loadTiming = $this->har['log']['pages'][0]['pageTimings']['onLoad'] ?? null;

        return is_null($loadTiming) || $loadTiming === -1
            ? null
            : round($loadTiming, $precision);
    }
}
