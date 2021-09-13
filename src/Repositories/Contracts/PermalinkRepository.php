<?php

namespace Latus\Permalink\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;
use Latus\Permalink\Models\Permalink;
use Latus\Repositories\Contracts\Repository;

interface PermalinkRepository extends Repository
{
    public function delete(Permalink $permalink);

    public function findByUrl(string $url): Model|null;

    public function setUrl(Permalink $permalink, string $url);
}