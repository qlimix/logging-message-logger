# Logging-message-logger

[![Travis CI](https://api.travis-ci.org/qlimix/logging-message-logger.svg?branch=master)](https://travis-ci.org/qlimix/logging-message-logger)
[![Coveralls](https://img.shields.io/coveralls/github/qlimix/logging-message-logger.svg)](https://coveralls.io/github/qlimix/logging-message-logger)
[![Packagist](https://img.shields.io/packagist/v/qlimix/logging-message-logger.svg)](https://packagist.org/packages/qlimix/logging-message-logger)
[![MIT License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](https://github.com/qlimix/logging-message-logger/blob/master/LICENSE)

Logging messages.

## Install

Using Composer:

~~~
$ composer require qlimix/logging-message-logger
~~~

## usage
```php
<?php

use Qlimix\Logging\Logger\Message\SerializableMessageLogger;
use Exception;

$logHandler = new FooBarLogHandler();
$logger = new SerializableMessageLogger($logHandler);

$logger->start($message);
$logger->success($message);
$logger->failed($message, new Exception());
$logger->critical($message, new Exception());
```


## Testing
To run all unit tests locally with PHPUnit:

~~~
$ vendor/bin/phpunit
~~~

## Quality
To ensure code quality run grumphp which will run all tools:

~~~
$ vendor/bin/grumphp run
~~~

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.
