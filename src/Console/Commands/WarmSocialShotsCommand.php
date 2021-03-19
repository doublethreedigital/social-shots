<?php

namespace DoubleThreeDigital\SocialShots\Console\Commands;

use DoubleThreeDigital\SocialShots\SocialShots;
use Illuminate\Console\Command;
use Statamic\Console\RunsInPlease;
use Statamic\Facades\Entry;

class WarmSocialShotsCommand extends Command
{
    use RunsInPlease;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'social-shots:warm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Warm Social Shots for all entries.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Entry::all()
            ->each(function ($entry) {
                $this->info("Generating for {$entry->slug()} [{$entry->id()}]");

                foreach (SocialShots::$imageTypes as $imageType) {
                    SocialShots::make(
                        $imageType['prefix'],
                        "socialShots::{$imageType['prefix']}::{$entry->slug()}",
                        $entry->toAugmentedArray()
                    );
                }
            });
    }
}
