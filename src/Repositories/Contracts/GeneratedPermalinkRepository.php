<?php

namespace Latus\Permalink\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface GeneratedPermalinkRepository
{
    public function generatePermalinks();

    public function attachCachablePermalink(string $url, string $modelClass, int $modelId, string $targetUrl);

    public function generatePermalinkFor(Model $model);

    public function all(): Collection;
}