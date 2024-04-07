<?php

use DeploymentHawk\Har;
use DeploymentHawk\Request;

beforeEach(function () {
    $this->har = new Har(
        file_get_contents(__DIR__.'/../chrome-github.com.har')
    );
});

test('total requests', function () {
    expect($this->har->totalRequests())->toEqual(99);
});

test('total requests by type', function () {
    expect($this->har->totalRequestsByType('script'))->toEqual(66)
        ->and($this->har->totalRequestsByType())->toBeArray()->toMatchArray([
            'document' => 1,
            'stylesheet' => 10,
            'script' => 66,
            'font' => 1,
            'image' => 12,
            'fetch' => 2,
            'xhr' => 1,
            'ping' => 4,
            'other' => 2,
        ]);

});

test('slowest request', function () {
    expect($this->har->slowestRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->slowestRequest()->url())->toEqual('https://api.github.com/_private/browser/stats')
        ->and($this->har->slowestRequest()->time())->toEqual(526.87);
});

test('fastest request', function () {
    expect($this->har->fastestRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->fastestRequest()->url())->toEqual('https://github.githubassets.com/favicons/favicon-dark.svg')
        ->and($this->har->fastestRequest()->time())->toEqual(12.49);
});

test('largest request', function () {
    expect($this->har->largestRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->largestRequest()->url())->toEqual('https://github.githubassets.com/assets/illu-copilot-editor-6474457a5b19.png')
        ->and($this->har->largestRequest()->size())->toEqual(241778);
});

test('smallest request', function () {
    expect($this->har->smallestRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->smallestRequest()->url())->toEqual('https://api.github.com/_private/browser/stats')
        ->and($this->har->smallestRequest()->size())->toEqual(0);
});

test('largest uncompressed request', function () {
    expect($this->har->largestUncompressedRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->largestUncompressedRequest()->url())->toEqual('https://github.githubassets.com/assets/vendors-node_modules_primer_octicons-react_dist_index_esm_js-node_modules_primer_react_lib-es-541a38-c07b07af7c0d.js')
        ->and($this->har->largestUncompressedRequest()->uncompressedSize())->toEqual(725634);
});

test('smallest uncompressed request', function () {
    expect($this->har->smallestUncompressedRequest())->toBeInstanceOf(Request::class)
        ->and($this->har->smallestUncompressedRequest()->url())->toEqual('https://collector.github.com/github/collect')
        ->and($this->har->smallestUncompressedRequest()->uncompressedSize())->toEqual(0);
});

test('total size', function () {
    expect($this->har->totalSize())->toEqual(1600544);
});

test('total size by type', function () {
    expect($this->har->totalSizeByType('script'))->toEqual(850740)
        ->and($this->har->totalSizeByType())->toBeArray()->toMatchArray([
            'document' => 45771,
            'stylesheet' => 149883,
            'script' => 850740,
            'font' => 84609,
            'image' => 449139,
            'fetch' => 12989,
            'xhr' => 4497,
            'ping' => 915,
            'other' => 2001,
        ]);
});

test('total uncompressed size', function () {
    expect($this->har->totalUncompressedSize())->toEqual(4896355);
});

test('total uncompressed size by type', function () {
    expect($this->har->totalUncompressedSizeByType('script'))->toEqual(3007450)
        ->and($this->har->totalUncompressedSizeByType())->toBeArray()->toMatchArray([
            'document' => 223478,
            'stylesheet' => 1092644,
            'script' => 3007450,
            'font' => 84388,
            'image' => 446352,
            'fetch' => 36174,
            'xhr' => 4328,
            'ping' => 0,
            'other' => 1541,
        ]);
});

test('onContentLoad timing', function () {
    expect($this->har->onContentLoadTiming())->toEqual(580.40)
        ->and($this->har->onContentLoadTiming(0))->toEqual(580)
        ->and($this->har->onContentLoadTiming(3))->toEqual(580.401);
});

test('onLoad timing', function () {
    expect($this->har->onLoadTiming())->toEqual(775.93)
        ->and($this->har->onLoadTiming(0))->toEqual(776)
        ->and($this->har->onLoadTiming(3))->toEqual(775.926);
});
