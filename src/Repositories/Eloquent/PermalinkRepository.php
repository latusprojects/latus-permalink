<?php

namespace Latus\Permalink\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Latus\Permalink\Models\Permalink;
use Latus\Repositories\EloquentRepository;
use Latus\Permalink\Repositories\Contracts\PermalinkRepository as PermalinkRepositoryContract;

class PermalinkRepository extends EloquentRepository implements PermalinkRepositoryContract
{

    public function delete(Permalink $permalink)
    {
        $permalink->delete();
    }

    public function findByUrl(string $url): Model|null
    {
        return Permalink::where('url', $url)->first();
    }

    public function setUrl(Permalink $permalink, string $url)
    {
        $permalink->url = $url;
        $permalink->save();
    }

    public function relatedModel(): Model
    {
        return new Permalink();
    }

    public function getAllByModel(Model $model): Collection
    {
        return $this->relatedModel()->where('related_model_class', get_class($model))->where('related_model_id', $model->id)->get();
    }
}