<?php

namespace Latus\Permalink\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Latus\Permalink\Repositories\Contracts\GeneratedPermalinkRepository;

class GeneratedPermalinkService
{
    public function __construct(
        protected GeneratedPermalinkRepository $generatedPermalinkRepository
    )
    {
    }

    public function generatePermalinks()
    {
        $this->generatedPermalinkRepository->generatePermalinks();
    }

    public function attachCachablePermalink(string $url, string $modelClass, int $modelId, string $targetUrl)
    {
        $this->generatedPermalinkRepository->attachCachablePermalink($url, $modelClass, $modelId, $targetUrl);
    }

    public function generatePermalinkFor(Model $model)
    {
        $this->generatedPermalinkRepository->generatePermalinkFor($model);

        $this->generatePermalinks();
    }

    public function all(): Collection
    {
        return $this->generatedPermalinkRepository->all();
    }

    public function urlIsPermalink(string $url): bool
    {
        return $this->all()->has($url);
    }

    public function getTargetUrl(string $url): string|null
    {
        return $this->urlIsPermalink($url)
            ? $this->all()->get($url)['target_url']
            : null;
    }
}