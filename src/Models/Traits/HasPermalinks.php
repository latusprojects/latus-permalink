<?php

namespace Latus\Permalink\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Latus\Permalink\Generators\Contracts\PermalinkGenerator;

trait HasPermalinks
{
    public abstract function getPermalinkGenerator(): PermalinkGenerator;

    public abstract function getPermalinkName(): string;

    public abstract function getPermalinkDate(): string;

    public abstract function getPermalinkId(): int|string;

    public function generatePermalink(string $syntax): string
    {
        if (!($this instanceof Model)) {
            throw new \TypeError('Target class "' . static::class . '" must be an instance of "Illuminate\Database\Eloquent\Model".');
        }

        return $this->getPermalinkGenerator()->generate($this, $syntax);
    }
}