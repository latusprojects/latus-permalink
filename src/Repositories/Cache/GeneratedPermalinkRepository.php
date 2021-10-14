<?php

namespace Latus\Permalink\Repositories\Cache;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Latus\Permalink\Database\Seeders\SettingSeeder;
use Latus\Permalink\Events\GeneratesPermalinks;
use Latus\Permalink\Services\PermalinkService;
use Latus\Settings\Services\SettingService;

class GeneratedPermalinkRepository implements \Latus\Permalink\Repositories\Contracts\GeneratedPermalinkRepository
{
    protected static array $generatedPermalinks = [];

    public function __construct(
        protected PermalinkService $permalinkService,
        protected SettingService   $settingService,
    )
    {
    }

    public function generatePermalinks()
    {
        app(SettingSeeder::class)->run();
        GeneratesPermalinks::dispatch();

        $fileContents = "<?php \n" .
            "return " . var_export(self::$generatedPermalinks, true) . ";";
        
        File::put(base_path('bootstrap/cache/permalinks.php'), $fileContents);
    }

    public function generatePermalinkFor(Model $model)
    {
        $storedPermalinks = $this->permalinkService->getAllByModel($model);

        if (!$storedPermalinks->isEmpty()) {
            foreach ($storedPermalinks as $permalink) {
                $url = $permalink->url;
                if (!isset($generatedPermalinks[$url])) {
                    self::$generatedPermalinks[$url] = [
                        'model_class' => $permalink->related_model_class,
                        'model_id' => $permalink->related_model_id,
                        'target_url' => $permalink->target_url,
                    ];
                }
            }
        }

        if (!method_exists($model, 'generatePermalink')) {
            return;
        }

        $modelClass = get_class($model);
        $syntax = json_decode($this->settingService->findByKey('permalink_syntaxes'), true)[$modelClass] ?? null;

        if (!$syntax) {
            return;
        }

        $targetUrl = $model->getTable() . '/' . $model->id;
        $modelId = $model->id;
        $url = $model->generatePermalink($syntax);

        if (!isset(self::$generatedPermalinks[$url])) {
            self::$generatedPermalinks[$url] = [
                'model_class' => $modelClass,
                'model_id' => $modelId,
                'target_url' => $targetUrl,
            ];
        }
    }

    public function all(): Collection
    {
        if (!stream_resolve_include_path(base_path('bootstrap/cache/permalinks.php'))) {
            return collect(self::$generatedPermalinks);
        }

        return collect(include base_path('bootstrap/cache/permalinks.php'));
    }
}