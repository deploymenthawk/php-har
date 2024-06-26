<?php

use DeploymentHawk\Request;

beforeEach(function () {
    $har = json_decode(file_get_contents(__DIR__.'/../chrome-github.com.har'), true);

    $this->request = new Request($har['log']['entries'][0]);
});

test('request url', function () {
    expect($this->request->url())->toEqual('https://github.com/');
});

test('request method', function () {
    expect($this->request->method())->toEqual('GET');
});

test('request status', function () {
    expect($this->request->status())->toEqual(200);
});

test('request type', function () {
    expect($this->request->type())->toEqual('document');
});

test('request priority', function () {
    expect($this->request->priority())->toEqual('VeryHigh');
});

test('request IP address', function () {
    expect($this->request->ipAddress())->toEqual('140.82.121.4');
});

test('request time', function () {
    expect($this->request->time())->toEqual(266.54)
        ->and($this->request->time(0))->toEqual(267)
        ->and($this->request->time(3))->toEqual(266.536);
});

test('request size', function () {
    expect($this->request->size())->toEqual(45771);
});

test('request uncompressed size', function () {
    expect($this->request->uncompressedSize())->toEqual(223478);
});

test('request timings', function () {
    expect($this->request->timings())->toEqual([
        'blocked' => 140.56,
        'dns' => 0.01,
        'ssl' => 28.38,
        'connect' => 52.07,
        'send' => 0.25,
        'wait' => 26.75,
        'receive' => 46.90,
        'ttfb' => 79.08,
    ]);
});

test('request blocked timing', function () {
    expect($this->request->blockedTiming())->toEqual(140.56)
        ->and($this->request->blockedTiming(0))->toEqual(141)
        ->and($this->request->blockedTiming(3))->toEqual(140.561);
});

test('request DNS timing', function () {
    expect($this->request->dnsTiming())->toEqual(0.01)
        ->and($this->request->dnsTiming(0))->toEqual(0)
        ->and($this->request->dnsTiming(3))->toEqual(0.010);
});

test('request connect timing', function () {
    expect($this->request->connectTiming())->toEqual(52.07)
        ->and($this->request->connectTiming(0))->toEqual(52)
        ->and($this->request->connectTiming(3))->toEqual(52.068);
});

test('request SSL timing', function () {
    expect($this->request->sslTiming())->toEqual(28.38)
        ->and($this->request->sslTiming(0))->toEqual(28)
        ->and($this->request->sslTiming(3))->toEqual(28.376);
});

test('request send timing', function () {
    expect($this->request->sendTiming())->toEqual(0.25)
        ->and($this->request->sendTiming(0))->toEqual(0)
        ->and($this->request->sendTiming(3))->toEqual(0.249);
});

test('request wait timing', function () {
    expect($this->request->waitTiming())->toEqual(26.75)
        ->and($this->request->waitTiming(0))->toEqual(27)
        ->and($this->request->waitTiming(3))->toEqual(26.748);
});

test('request receive timing', function () {
    expect($this->request->receiveTiming())->toEqual(46.90)
        ->and($this->request->receiveTiming(0))->toEqual(47)
        ->and($this->request->receiveTiming(3))->toEqual(46.900);
});

test('request ttfb timing', function () {
    expect($this->request->ttfbTiming())->toEqual(79.08)
        ->and($this->request->ttfbTiming(0))->toEqual(79)
        ->and($this->request->ttfbTiming(3))->toEqual(79.075);
});

test('request headers', function () {
    expect($this->request->requestHeaders())->toBeArray()
        ->and($this->request->requestHeaders()[0])->toMatchArray([
            'name' => ':authority',
            'value' => 'github.com',
        ]);
});

test('request response headers', function () {
    expect($this->request->responseHeaders())->toBeArray()
        ->and($this->request->responseHeaders()[0])->toMatchArray([
            'name' => 'accept-ranges',
            'value' => 'bytes',
        ]);
});
