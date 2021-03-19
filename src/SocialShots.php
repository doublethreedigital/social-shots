<?php

namespace DoubleThreeDigital\SocialShots;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Statamic\Facades\Parse;

class SocialShots
{
    public static array $imageTypes = [
        'og' => [
            'prefix'  => 'og',
            'width'   => 1200,
            'height'  => 630,
        ],
        'twitter' => [
            'prefix'  => 'twitter',
            'width'   => 600,
            'height'  => 335,
        ],
    ];

    public static function make(string $imageType, string $cacheKey, array $data)
    {
        return Cache::remember($cacheKey, now()->addMinutes(config('social-shots.cache_length')), function () use ($imageType, $data) {
            $viewPath  = static::findView($data);
            $imageType = static::$imageTypes[$imageType];

            if (! $viewPath) {
                throw new Exceptions\NoSocialShotViewFound("Social Shots found no views for this page. A view is required to generate a social image.");
            }

            return static::generateImage($imageType, $viewPath, $data);
        });
    }

    public static function generateImage(array $imageType, string $viewPath, array $data): string
    {
        $fileName = isset($data['slug'])
            ? "{$imageType['prefix']}__{$data['slug']}.png"
            : "{$imageType['prefix']}__{$data['last_segment']}.png";

        $renderedView = (string) Parse::template(File::get($viewPath), $data);

        Browsershot::html($renderedView)
            ->windowSize($imageType['width'], $imageType['height'])
            ->save(Storage::disk(config('social-shots.filesystem_disk'))->path($fileName));

        return Storage::url($fileName);
    }

    protected static function findView(array $data): string
    {
        $possibleViews = ['social_shots.default'];

        if (isset($data['collection'])) {
            $possibleViews[] = "social_shots.{$data['collection']->handle()}";
        }

        if (isset($data['slug'])) {
            $possibleViews[] = "social_shots.{$data['slug']}";
        }

        return collect($possibleViews)
            ->reverse()
            ->filter(function ($view) {
                return View::exists($view);
            })
            ->map(function ($view) {
                $viewFinder = app('view.finder');
                $viewFinder->addExtension('antlers.html');
                $viewFinder->addExtension('antlers.php');

                return $viewFinder->find($view);
            })
            ->first();
    }
}
