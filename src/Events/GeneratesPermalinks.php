<?php

namespace Latus\Permalink\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Latus\Permalink\Services\GeneratedPermalinkService;

class GeneratesPermalinks
{
    use Dispatchable;

    protected GeneratedPermalinkService $generatedPermalinkService;

    public function getGeneratedPermalinkService(): GeneratedPermalinkService
    {
        if (!isset($this->{'generatedPermalinkService'})) {
            $this->generatedPermalinkService = app(GeneratedPermalinkService::class);
        }

        return $this->generatedPermalinkService;
    }
}