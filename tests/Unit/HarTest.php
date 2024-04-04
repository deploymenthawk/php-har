<?php

use DeploymentHawk\Har;
use DeploymentHawk\Request;

beforeEach(function () {
    $this->har = new Har(
        file_get_contents(__DIR__ . '/../github.com.har')
    );
});

test('count total requests', function () {
    expect($this->har->totalRequests())->toEqual(103);
});

test('slowest request', function () {
    expect($this->har->slowestRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->slowestRequest()->url())->toEqual('https://api.github.com/_private/browser/stats')
        ->and($this->har->slowestRequest()->totalTime())->toEqual(271.31);
});

test('fastest request', function () {
    expect($this->har->fastestRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->fastestRequest()->url())->toEqual('https://github.githubassets.com/assets/vendors-node_modules_oddbird_popover-polyfill_dist_popover_js-7bd350d761f4.js')
        ->and($this->har->fastestRequest()->totalTime())->toEqual(0.03);
});

test('get onContentLoad timing', function () {
    expect($this->har->onContentLoadTiming())->toEqual(228.1)
        ->and($this->har->onContentLoadTiming(0))->toEqual(228)
        ->and($this->har->onContentLoadTiming(3))->toEqual(228.102);
});

test('get onLoad timing', function () {
    expect($this->har->onLoadTiming())->toEqual(450.16)
        ->and($this->har->onLoadTiming(0))->toEqual(450)
        ->and($this->har->onLoadTiming(3))->toEqual(450.164);
});
