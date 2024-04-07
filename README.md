# PHP HAR

[![GitHub Tests Action](https://github.com/deploymenthawk/php-har/actions/workflows/tests.yml/badge.svg)](https://github.com/deploymenthawk/php-har/actions/workflows/tests.yml)
[![Packagist Version](https://img.shields.io/packagist/v/deploymenthawk/php-har)](https://packagist.org/packages/deploymenthawk/php-har)
[![Packagist License](https://img.shields.io/packagist/l/deploymenthawk/php-har)](LICENSE.md)

PHP HAR is a lightweight package for working with [HTTP Archive (HAR)](http://www.softwareishard.com/blog/har-12-spec/)
files. Built with ❤️ by [DeploymentHawk](https://deploymenthawk.com).

## Installation

You can install the package via Composer:

```bash
composer require deploymenthawk/php-har
```

## Usage

Create a new instance of `Har`, by passing in your HAR JSON export:

```php
$har = new \DeploymentHawk\Har($json);
```

### Requests

#### `totalRequests()`

Return the total number of network requests:

```php
$har->totalRequests(); // 99
```

#### `requests()`

Return a `Collection` of network requests:

```php
$har->requests()->each(function(\DeploymentHawk\Request $request) {
    $request->url(); // https://github.com/
    $request->method(); // GET
    $request->status(); // 200
    $request->type(); // document
    $request->priority(); // VeryHigh
    $request->ipAddress(); // 140.82.121.4
    $request->time(); // 266.54
    $request->size(); // 45771
    $request->uncompressedSize(); // 223478
    $request->blockedTiming(); // 140.56
    $request->dnsTiming(); // 0.01
    $request->connectTiming(); // 52.07
    $request->sslTiming(); // 28.38
    $request->sendTiming(); // 0.25
    $request->waitTiming(); // 26.75
    $request->receiveTiming(); // 46.90
    $request->requestHeaders() // [name => value, ...]
    $request->responseHeaders() // [name => value, ...]
})
```

#### `fastestRequest()`

Return the fastest network request:

```php
$har->fastestRequest(); // \DeploymentHawk\Request
```

#### `slowestRequest()`

Return the slowest network request:

```php
$har->slowestRequest(); // \DeploymentHawk\Request
```

#### `largestRequest()`

Return the largest network request:

```php
$har->largestRequest(); // \DeploymentHawk\Request
```

#### `smallestRequest()`

Return the smallest network request:

```php
$har->smallestRequest(); // \DeploymentHawk\Request
```

### Page Weight

#### `totalSize()`

Return the total number of bytes transferred for all network requests:

```php
$har->totalSize(); // 1600544
```

#### `totalUncompressedSize()`

Return the total number of bytes for all resources:

```php
$har->totalUncompressedSize(); // 4896355
```

### Timings

#### `onContentLoadTiming()`

Return the time in milliseconds when the `DOMContentLoaded` event fired:

```php
$har->onContentLoadTiming(); // 580.40
```

#### `onLoadTiming()`

Return the time in milliseconds when the `load` event fired:

```php
$har->onLoadTiming(); // 775.93
```