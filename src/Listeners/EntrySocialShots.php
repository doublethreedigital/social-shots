<?php

namespace DoubleThreeDigital\SocialShots\Listeners;

use DoubleThreeDigital\SocialShots\Jobs\GenerateSocialShot;
use Illuminate\Support\Facades\Config;
use Statamic\Events\EntrySaved;

class EntrySocialShots
{
    public function handle(EntrySaved $event)
    {
        $entry = $event->entry;
        $shotConfigurations = Config::get("social-shots.collections.{$entry->collection()->handle()}.{$entry->blueprint()->handle()}");

        if (! $shotConfigurations) {
            return;
        }

        collect($shotConfigurations)
            ->each(function ($imageType, $field) use ($entry) {
                // Some sort of validation to ensure the $imageType given is a proper thing

                GenerateSocialShot::dispatch($entry, $field, $imageType);
            });
    }
}
