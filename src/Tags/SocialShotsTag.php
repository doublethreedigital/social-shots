<?php

namespace DoubleThreeDigital\SocialShots\Tags;

use DoubleThreeDigital\SocialShots\SocialShots;
use Illuminate\Support\Facades\Cache;
use Statamic\Tags\Tags;

class SocialShotsTag extends Tags
{
    protected static $handle = 'social-shots';

    public function og()
    {
        $requestPath = $this->context->get('slug');
        $cacheKey = "socialShots::og::{$requestPath}";

        $this->handleCacheInvalidation($cacheKey);

        return SocialShots::make('og', $cacheKey, $this->context->toArray());
    }

    public function twitter()
    {
        $requestPath = $this->context->get('slug');
        $cacheKey = "socialShots::twitter::{$requestPath}";

        $this->handleCacheInvalidation($cacheKey);

        return SocialShots::make('twitter', $cacheKey, $this->context->toArray());
    }

    protected function handleCacheInvalidation(string $cacheKey)
    {
        if (request()->input('purge_social_shot')) {
            Cache::forget($cacheKey);
        }
    }
}
