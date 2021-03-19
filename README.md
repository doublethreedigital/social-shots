![Banner](https://raw.githubusercontent.com/doublethreedigital/social-shots/master/banner.png)

## Social Shots

Social Shots allows you to generate social sharing images dynamically. All you need is HTML, CSS & Antlers.

This repository contains the source code of Social Shots. While Social Shots itself is free and doesn't require a license, you can [donate to Duncan](https://duncanm.dev/donate), the developer behind it to show your appreciation.

## Installation

### Addon installation

1. Install via Composer `composer require doublethreedigital/social-shots`
2. Publish configuration, assets etc `php artisan vendor:publish --provider="DoubleThreeDigital\SocialShots\ServiceProvider"`

### Puppeteer installation

Under the hood, this addon uses something called [Puppeteer](https://github.com/GoogleChrome/puppeteer) (via [Browsershot](https://github.com/spatie/browsershot)), which provides an easy way to take screenshots via a headless version of Chrome.

Because of this, you'll also need to install Puppeteer whereever you want to run this addon, in a local environment or on your server.

We've provided some copy & paste snippets which should work for most environments. If these install steps don't work for you, please research setting up Puppeteer for your operating system.

**macOS**

```
npm install puppeteer --global
```

**Ubuntu (works for Forge provisioned servers)**

```
curl -sL https://deb.nodesource.com/setup_12.x | sudo -E bash -
sudo apt-get install -y nodejs gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 libexpat1 libfontconfig1 libgbm1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation libappindicator1 libnss3 lsb-release xdg-utils wget libgbm-dev
sudo npm install --global --unsafe-perm puppeteer
sudo chmod -R o+rx /usr/lib/node_modules/puppeteer/.local-chromium
```

## Documentation

### Configuration

This addon provides its own configuration file. You can use this to configure the API keys and other options.

```php
return [
    //
];
```

### Usage in layout

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
