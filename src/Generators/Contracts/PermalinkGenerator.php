<?php

namespace Latus\Permalink\Generators\Contracts;

use Illuminate\Database\Eloquent\Model;

interface PermalinkGenerator
{
    public const SYNTAX_DATE_NAME = '{{date}}/{{name}}';
    public const SYNTAX_NAME_DATE = '{{name}}/{{date}}';
    public const SYNTAX_NAME = '{{name}}';
    public const SYNTAX_ID_NAME_DATE = '{{id}}/{{name}}/{{date}}';
    public const SYNTAX_ID_NAME = '{{id}}/{{name}}';

    public function generate(Model $model, string $syntax, \Closure $callback = null): string;
}