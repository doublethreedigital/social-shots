<?php

namespace DoubleThreeDigital\SocialShots\Jobs;

use DoubleThreeDigital\SocialShots\Exceptions\SocialShotViewNotFound;
use DoubleThreeDigital\SocialShots\SocialShots;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Spatie\Browsershot\Browsershot;
use Statamic\Contracts\Entries\Entry;
use Statamic\Facades\Asset;
use Statamic\Facades\AssetContainer;
use Statamic\Facades\Parse;

class GenerateSocialShot implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected $entry;
    protected $field;
    protected $imageType;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Entry $entry, string $field, string $imageType)
    {
        $this->entry = $entry;
        $this->field = $field;
        $this->imageType = $imageType;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $viewPath = $this->getViewPath();
        $imageType = SocialShots::$imageTypes[$this->imageType];
        $assetContainer = AssetContainer::findByHandle(config('social-shots.storage.container'));

        if (! $viewPath) {
            throw new SocialShotViewNotFound("Social Shots could not find a view for [$this->entry->id()]. Please create a view and try again.");
        }

        $filePath = "{$this->entry->collection()->handle()}/{$this->entry->id()}/{$this->imageType}.png";

        $renderedView = (string) Parse::template(File::get($viewPath), $this->entry->toAugmentedArray());

        Browsershot::html($renderedView)
            ->windowSize($imageType['width'], $imageType['height'])
            ->save(Storage::disk($assetContainer->diskHandle())->path($filePath));

        return Storage::disk($assetContainer->diskHandle())->url($filePath);
    }

    protected function getViewPath()
    {
        $possibleViews = [
            'social_shot',
            'social_shots.default',
            "social_shots.{$this->entry->collection()->handle()}",
            "social_shots.{$this->entry->collection()->handle()}.{$this->imageType}",
            "social_shots.{$this->entry->collection()->handle()}.{$this->entry->blueprint()->handle()}",
            "social_shots.{$this->entry->collection()->handle()}.{$this->entry->blueprint()->handle()}.{$this->imageType}",
        ];

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
