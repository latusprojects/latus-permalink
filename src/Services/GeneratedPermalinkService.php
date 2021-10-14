<?php

namespace Latus\Permalink\Services;

use Illuminate\Database\Eloquent\Model;
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

    public function generatePermalinkFor(Model $model)
    {
        $this->generatedPermalinkRepository->generatePermalinkFor($model);
    }

    public function all(): Collection
    {
        return $this->generatedPermalinkRepository->all();
    }
}