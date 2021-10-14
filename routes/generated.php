<?php

use Illuminate\Support\Facades\Route;

if (stream_resolve_include_path(base_path('bootstrap/cache/permalinks.php'))) {
    $routes = include base_path('bootstrap/cache/permalinks.php');

    foreach ($routes as $url => $meta) {
        Route::get($url)->setUri($meta['target_url']);
    }
}