<?php

use DeploymentHawk\Har;

beforeEach(function () {
    $this->har = new Har(
        file_get_contents(__DIR__ . '/../github.com.har')
    );
});

test('count total requests', function () {
    expect($this->har->totalRequests())->toEqual(103);
});

test('get onContentLoad timing', function () {
    expect($this->har->onContentLoadTiming())->toEqual(228.1)
        ->and($this->har->onContentLoadTiming(3))->toEqual(228.102);
});

test('get onLoad timing', function () {
    expect($this->har->onLoadTiming())->toEqual(450.16)
        ->and($this->har->onLoadTiming(3))->toEqual(450.164);
});
