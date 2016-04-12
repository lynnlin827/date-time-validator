# date-time-validator

[![Build Status](https://img.shields.io/travis/lynn80827/date-time-validator/master.svg?style=flat-square)](https://travis-ci.org/lynn80827/date-time-validator)
[![codecov.io](https://img.shields.io/codecov/c/github/lynn80827/date-time-validator/master.svg?style=flat-square)](https://codecov.io/github/lynn80827/date-time-validator?branch=master)
[![Packagist](https://img.shields.io/packagist/v/lynnlin/date-time-validator.svg?style=flat-square)](https://packagist.org/packages/lynnlin/date-time-validator)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?style=flat-square)](http://lynn.mit-license.org/)

## Description

Add a new validation rule `during` to validate whether the given date time is in a specific period which is 6 months by default.

## Installation

Install the package via composer.

```bash
composer require lynnlin/date-time-validator
```

Add the service provider into `config/app.php`.

```php
'providers' => [
	...
	App\Providers\ValidatorServiceProvider::class,
	...
]
```

## Usage

```php
use Illuminate\Support\Facades\Validator;

// check 20160123 whether it is in 6 months ago from today
Validator::make(
    ['startAt' => '20160123'],
    ['startAt' => 'during']
);

// check 20150123 whether it is in 1 year ago from today since endAt is not given in the first argument
Validator::make(
    ['startAt' => '20150123'],
    ['startAt' => 'during:endAt,1Y', 'endAt' => 'string']
);

// check 20150123 whether it is in 1 day from 20150124
Validator::make(
    ['startAt' => '20150123', 'endAt' => '20150124'],
    ['startAt' => 'during:endAt,1d', 'endAt' => 'string']
);

// check 20150123 whether it is in 1 week from 20150124
Validator::make(
    ['startAt' => '20150123', 'endAt' => '20150124'],
    ['startAt' => 'during:endAt,1w', 'endAt' => 'string']
);
```
