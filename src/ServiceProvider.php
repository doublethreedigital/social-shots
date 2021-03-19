<?php

namespace DoubleThreeDigital\SocialShots;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [
        Console\Commands\WarmSocialShotsCommand::class,
    ];

    protected $tags = [
        Tags\SocialShotsTag::class,
    ];
}
