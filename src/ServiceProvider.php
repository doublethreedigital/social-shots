<?php

namespace DoubleThreeDigital\SocialShots;

use Statamic\Events\EntrySaved;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $commands = [
        Console\Commands\WarmSocialShotsCommand::class,
    ];

    protected $listen = [
        EntrySaved::class => [
            Listeners\EntrySocialShots::class,
        ],
    ];
}
