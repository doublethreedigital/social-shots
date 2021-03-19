<?php

namespace DoubleThreeDigital\SocialShots;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Statamic\Entries\Collection;
use Statamic\Facades\Parse;

class SocialShots
{
    // TODO: Configurables
    // Cache length
    // Where to save images - maybe an asset container?

    protected static array $imageTypes = [
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
        return Cache::remember($cacheKey, now()->addMinute(), function () use ($imageType, $data) {
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
        $savePath = 'assets/social-shots/' . $imageType['prefix'] . $data['slug'] . '.png';

        $renderedView = (string) Parse::template(
            File::get($viewPath),
            $data
        );

        Browsershot::html($renderedView)
            ->windowSize($imageType['width'], $imageType['height'])
            ->save(public_path($savePath));

        return asset($savePath);
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
