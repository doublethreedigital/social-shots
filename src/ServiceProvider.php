<?php

namespace DoubleThreeDigital\SocialShots;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [
        Console\Commands\WarmSocialShots::class,
    ];

    protected $tags = [
        Tags\SocialImageTag::class,
    ];
}
