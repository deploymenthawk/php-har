<?php

use DeploymentHawk\Request;

beforeEach(function () {
    $har = json_decode(file_get_contents(__DIR__.'/../github.com.har'), true);

    $this->request = new Request($har['log']['entries'][0]);
});

test('request url', function () {
    expect($this->request->url())->toEqual('https://github.com/');
});

test('request total time', function () {
    expect($this->request->totalTime())->toEqual(29.95)
        ->and($this->request->totalTime(0))->toEqual(30)
        ->and($this->request->totalTime(3))->toEqual(29.950);
});

test('request blocked timing', function () {
    expect($this->request->blockedTiming())->toEqual(1.18)
        ->and($this->request->blockedTiming(0))->toEqual(1)
        ->and($this->request->blockedTiming(3))->toEqual(1.175);
});

test('request DNS timing', function () {
    expect($this->request->dnsTiming())->toBeNull();
});

test('request connect timing', function () {
    expect($this->request->connectTiming())->toBeNull();
});

test('request SSL timing', function () {
    expect($this->request->sslTiming())->toBeNull();
});

test('request send timing', function () {
    expect($this->request->sendTiming())->toEqual(0.14)
        ->and($this->request->sendTiming(0))->toEqual(0)
        ->and($this->request->sendTiming(3))->toEqual(0.142);
});

test('request wait timing', function () {
    expect($this->request->waitTiming())->toEqual(27.85)
        ->and($this->request->waitTiming(0))->toEqual(28)
        ->and($this->request->waitTiming(3))->toEqual(27.846);
});

test('request receive timing', function () {
    expect($this->request->receiveTiming())->toEqual(0.79)
        ->and($this->request->receiveTiming(0))->toEqual(1)
        ->and($this->request->receiveTiming(3))->toEqual(0.787);
});
