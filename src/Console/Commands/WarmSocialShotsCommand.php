<?php

namespace DoubleThreeDigital\SocialShots\Console\Commands;

use DoubleThreeDigital\SocialShots\SocialImage;
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
    protected $description = 'Warm social images for all entries.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Entry::all()
            ->each(function ($entry) {
                $this->info("Generating for {$entry->slug()}");

                // OG
                $requestPath = $entry->slug();
                $cacheKey = "og_social_image_{$requestPath}";

                SocialImage::make(
                    $cacheKey,
                    $requestPath,
                    'social_images.default',
                    $entry->toAugmentedArray(),
                    'og_'.$requestPath,
                    1200,
                    630
                );

                // Twitter
                $requestPath = $entry->slug();
                $cacheKey = "twitter_social_image_{$requestPath}";

                return SocialImage::make(
                    $cacheKey,
                    $requestPath,
                    'social_images.default',
                    $entry->toAugmentedArray(),
                    'twitter_'.$requestPath,
                    600,
                    335
                );
            });
    }
}
