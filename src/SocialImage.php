<?php

namespace DoubleThreeDigital\SocialShots;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Spatie\Browsershot\Browsershot;
use Statamic\Facades\Parse;

class SocialImage
{
    // TODO: move this to a config
    protected static $imagesPath = 'assets/social-shots';

    public static function make(string $cacheKey, string $slug = '/', string $viewName, array $viewData, string $imageName, int $width, int $height)
    {
        return Cache::remember($cacheKey, now()->addWeek(), function () use ($slug, $viewName, $viewData, $imageName, $width, $height) {
            return static::generateImage(
                $viewName,
                $viewData,
                $imageName.'_'.$slug,
                $width,
                $height
            );
        });
    }

    public static function generateImage(string $viewName, array $viewData, string $imageName, int $width, int $height): string
    {
        $viewFinder = app('view.finder');
        $viewFinder->addExtension('antlers.html');
        $viewFinder->addExtension('antlers.php');

        $viewFilePath = $viewFinder->find($viewName);
        $savePath = static::$imagesPath . '/' . $imageName . '.png';

        $renderedView = (string) Parse::template(
            File::get($viewFilePath),
            $viewData
        );

        Browsershot::html($renderedView)
            ->windowSize($width, $height)
            ->save(public_path($savePath));

        return asset($savePath);
    }
}
