[![Build Status](https://travis-ci.org/Random-Host/PHP_Countdown.svg)](https://travis-ci.org/Random-Host/PHP_Countdown)

PHP_Countdown
=============

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

require 'psr0.autoloader.php';

// set default timezone
date_default_timezone_set('UTC');

// setup date object
$start = new DateTime('OCT 21 2015 04:29 PM');

// setup countdown
$countdown = new Countdown($start);

// returns a \DateInterval object
var_export($countdown->getDateDiff());
```

This will instantiate the countdown and return a \DateInterval object.

System-Wide Installation
------------------------

PHP_Countdown should be installed using the [PEAR Installer](http://pear.php.net).
This installer is the PHP community's de-facto standard for installing PHP
components.

    sudo pear channel-discover pear.random-host.com
    sudo pear install --alldeps randomhost/PHP_Countdown

As A Dependency On Your Component
---------------------------------

If you are creating a component that relies on PHP_Countdown, please make sure that
you add PHP_Countdown to your component's package.xml file:

```xml
<dependencies>
  <required>
    <package>
      <name>PHP_Countdown</name>
      <channel>pear.random-host.com</channel>
      <min>1.0.0</min>
      <max>1.999.9999</max>
    </package>
  </required>
</dependencies>
```

Development Environment
-----------------------

If you want to patch or enhance this component, you will need to create a
suitable development environment. The easiest way to do that is to install
phix4componentdev:

    # phix4componentdev
    sudo apt-get install php5-xdebug
    sudo apt-get install php5-imagick
    sudo pear channel-discover pear.phix-project.org
    sudo pear -D auto_discover=1 install -Ba phix/phix4componentdev

You can then clone the git repository:

    # PHP_Countdown
    git clone https://github.com/Random-Host/PHP_Countdown.git

Then, install a local copy of this component's dependencies to complete the
development environment:

    # build vendor/ folder
    phing build-vendor

To make life easier for you, common tasks (such as running unit tests,
generating code review analytics, and creating the PEAR package) have been
automated using [phing](http://phing.info).  You'll find the automated steps
inside the build.xml file that ships with the component.

Run the command 'phing' in the component's top-level folder to see the full list
of available automated tasks.

License
-------

See LICENSE.txt for full license details.
