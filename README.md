[![Build Status][0]][1]

randomhost/countdown
====================

This package uses PHP Date functions to calculate the difference between two
\DateTime objects while adding additional functionality such as disallowing
negative values.

It is meant for displaying countdown timers on websites.

Usage
-----

A basic approach at using this package could look like this:

```php
<?php
namespace randomhost\Date;

require_once '/path/to/vendor/autoload.php';

// set default timezone
date_default_timezone_set('UTC');

// setup date object
$start = new \DateTime('OCT 21 2015 04:29 PM');

// setup countdown
$countdown = new Countdown($start);

// returns a \DateInterval object
var_export($countdown->getDateDiff());
```

This will instantiate the countdown and return a \DateInterval object.

License
-------

See LICENSE.txt for full license details.

[0]: https://travis-ci.org/randomhost/countdown.svg?branch=master
[1]: https://travis-ci.org/randomhost/countdown
