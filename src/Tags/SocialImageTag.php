<?php

namespace DoubleThreeDigital\SocialShots\Tags;

use DoubleThreeDigital\SocialShots\SocialImage;
use Illuminate\Support\Facades\Cache;
use Statamic\Tags\Tags;

class SocialImageTag extends Tags
{
    protected static $handle = 'socialImage';

    public function og()
    {
        $requestPath = $this->context->get('slug');
        $cacheKey = "og_social_image_{$requestPath}";

        if (request()->input('social_image_purge')) {
            Cache::forget("social_image_{$requestPath}");
        }

        return SocialImage::make(
            $cacheKey,
            $requestPath,
            'social_images.default',
            $this->context->except('app')->toArray(),
            'og_'.$requestPath,
            1200,
            630
        );
    }

    public function twitter()
    {
        $requestPath = $this->context->get('slug');
        $cacheKey = "twitter_social_image_{$requestPath}";

        if (request()->input('social_image_purge')) {
            Cache::forget("social_image_{$requestPath}");
        }

        return SocialImage::make(
            $cacheKey,
            $requestPath,
            'social_images.default',
            $this->context->except('app')->toArray(),
            'twitter_'.$requestPath,
            600,
            335
        );
    }
}
