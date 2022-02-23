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
            $permalink = Str::replace('{{name}}',
                    urlencode(Str::replace(' ', '-', preg_replace('/[^A-Za-z0-9\-]/', '', $model->getPermalinkName()))),
                $permalink);
        }

        if (method_exists($model, 'getPermalinkDate')) {
            $permalink = Str::replace('{{date}}', $model->getPermalinkDate(), $permalink);
        }

        if (method_exists($model, 'getPermalinkId')) {
            $permalink = Str::replace('{{id}}', $model->getPermalinkId(), $permalink);
        }

        return $permalink;
    }
}