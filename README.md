# PHP HAR

![GitHub Tests Action](https://github.com/deploymenthawk/php-har/actions/workflows/tests.yml/badge.svg)
![Packagist Version](https://img.shields.io/packagist/v/deploymenthawk/php-har)
![Packagist License](https://img.shields.io/packagist/l/deploymenthawk/php-har)

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