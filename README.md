
![Slynova](https://cloud.githubusercontent.com/assets/2793951/8206037/35841f80-14f6-11e5-8538-b378cd632d28.png)

# Laravel-ACL

[![Build Status](https://img.shields.io/travis/Slynova-Org/laravel-acl/master.svg?style=flat-square)](https://travis-ci.org/Slynova-Org/laravel-acl)
[![Coveralls](https://img.shields.io/coveralls/Slynova-Org/laravel-acl/master.svg?style=flat-square)](https://coveralls.io/r/Slynova-Org/laravel-acl?branch=master)
[![Code Quality](https://img.shields.io/scrutinizer/g/Slynova-Org/laravel-acl/master.svg?style=flat-square)](https://scrutinizer-ci.com/g/Slynova-Org/laravel-acl)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](https://tldrlegal.com/license/mit-license)
[![Total Downloads](https://img.shields.io/packagist/dt/slynova/laravel-acl.svg?style=flat-square)](https://packagist.org/packages/slynova/laravel-acl)

[![SensioLabs Insight](https://insight.sensiolabs.com/projects/191efc44-8b8b-4944-be05-39ee2b29b919/big.png)](https://insight.sensiolabs.com/projects/191efc44-8b8b-4944-be05-39ee2b29b919)

Laravel ACL adds role based permissions to Laravel 5.1.

**Note that this package is still in development and doesn't have a stable release. You should not use it in production! Behaviors will maybe change or be removed. You can look at our [Roadmap](#roadmap).**

# Table of Contents

* [Requirements](#requirements)
* [Contribution Guidelines](#contribution-guidelines)
* [Getting Started](#getting-started)
* [Roadmap](#roadmap)
* [Change Logs](#change-logs)

# <a name="requirements"></a>Requirements

* As Laravel 5.1 require PHP 5.5+, we required the same version.

# <a name="getting-started"></a>Getting Started

1. Require the package in your `composer.json` and update your dependency with `composer update`:

    ```
    "require": {
        ...
        "slynova/laravel-acl": "dev-master",
        ...
    },
    ```

2. Add the package to your application service providers in `config/app.php`.
    ```php
    'providers' => [

        Illuminate\Foundation\Providers\ArtisanServiceProvider::class,
        Illuminate\Auth\AuthServiceProvider::class,
        ...
        Slynova\Acl\AclServiceProvider::class,

    ],
    ```

3. Publish the package migrations and configuration to your application.
    ```shell
    $ php artisan vendor:publish --provider="Slynova\Acl\AclServiceProvider" --tag="config"
    $ php artisan vendor:publish --provider="Slynova\Acl\AclServiceProvider" --tag="migrations"
    $ php artisan migrate
    ```

# <a name="roadmap"></a>Roadmap

Here's the TODO list for the beta release.

- [ ] Handle "OR" in condition.
- [ ] Handle multiple roles for a user (precedence).
- [ ] Handle globals conditions in `view`, `create` and `update`.

Here's the TODO list for the stable release (**1.0**).

- [ ] Cache permissions for a user.
- [ ] Create console commands to cache or clean permissions.
- [ ] Create middleware to protect route.
- [ ] Create an API to easily create permission.
- [ ] Create an example application to show how to use this package.
- [ ] Create a general PHP package and just use a driver for Laravel.
- [ ] Get 100% in code coverage.
- [ ] Get 10 score in Scrunitizer.
- [ ] Clean the code.

# <a name="change-logs"></a>Change Logs

Nothing will be wrote here before the first stable release.

# <a name="contribution-guidelines"></a>Contribution Guidelines

Support follows PSR-2 PHP coding standards, and semantic versioning.

Please report any issue you find in the issues page.
Pull requests are welcome.
