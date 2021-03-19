![Banner](https://raw.githubusercontent.com/doublethreedigital/social-shots/master/banner.png)

## Social Shots

Social Shots allows you to generate social sharing images dynamically. All you need is HTML, CSS & Antlers.

This repository contains the source code of Social Shots. While Social Shots itself is free and doesn't require a license, you can [donate to Duncan](https://duncanm.dev/donate), the developer behind it to show your appreciation.

## Installation

1. Install via Composer `composer require doublethreedigital/social-shots`
2. Publish configuration, assets etc `php artisan vendor:publish --provider="DoubleThreeDigital\SocialShots\ServiceProvider"`

## Documentation

### Configuration

This addon provides its own configuration file. You can use this to configure the API keys and other options.

```php
return [
    //
];
```

### Templating

access to cascade, limitations, view names

### Caching

we can't regenerate on every request, we use caching blah blah blah. You can get round by using query param... you can warm with command (maybe have subsection on that?)

## Security

From a security perspective, only the latest version will receive a security release if a vulnerability is found.

If you discover a security vulnerability within social-shots, please report it [via email](mailto:hello@doublethree.digital) straight away. Please don't report security issues in the issue tracker.

## Resources

* [**Issue Tracker**](https://github.com/doublethreedigital/social-shots/issues): Find & report bugs in Social Shots
* [**Discussions**](https://github.com/doublethreedigital/social-shots/discussions): Get help and put forward feature requests
* [**Email**](mailto:hello@doublethree.digital): Support from the developer behind the addon

---

<p>
<a href="https://statamic.com"><img src="https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge" alt="Compatible with Statamic v3"></a>
<a href="https://packagist.org/packages/doublethreedigital/social-shots/stats"><img src="https://img.shields.io/packagist/v/doublethreedigital/social-shots?style=for-the-badge" alt="Social Shots on Packagist"></a>
</p>
