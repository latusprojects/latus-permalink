<?php

namespace Latus\Permalink\Generators;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermalinkGenerator implements Contracts\PermalinkGenerator
{

    public function generate(Model $model, string $syntax, \Closure $callback = null): string
    {
        $permalink = $syntax;

        if (method_exists($model, 'getPermalinkName')) {
            $permalink = Str::replaceArray('{{name}}', $model->getPermalinkName(), $permalink);
        }

        if (method_exists($model, 'getPermalinkDate')) {
            $permalink = Str::replaceArray('{{date}}', $model->getPermalinkDate(), $permalink);
        }

        if (method_exists($model, 'getPermalinkId')) {
            $permalink = Str::replaceArray('{{id}}', $model->getPermalinkId(), $permalink);
        }

        return $permalink;
    }
}