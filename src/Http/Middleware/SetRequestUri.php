<?php

namespace Latus\Permalink\Http\Middleware;

use Illuminate\Http\Request;
use Latus\Permalink\Services\GeneratedPermalinkService;

class SetRequestUri
{
    public function __construct(
        protected GeneratedPermalinkService $permalinkService,
    )
    {
    }

    /**
     * Updates the $_SERVER['REQUEST_URI'] with target-url
     * if the current request-uri matches a generated permalink-pattern
     *
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        $requestUrl = ltrim($request->getRequestUri(), '/');

        if ($this->permalinkService->urlIsPermalink($requestUrl)) {

            $targetUrl = '/' . $this->permalinkService->getTargetUrl($requestUrl);

            $_SERVER['REQUEST_URI'] = $targetUrl;

            return $next(Request::capture());
        }

        return $next($request);
    }
}