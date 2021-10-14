<?php

namespace Latus\Permalink\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Latus\Permalink\Models\Permalink;
use Latus\Permalink\Repositories\Contracts\PermalinkRepository;

class PermalinkService
{

    public static array $createValidationRules = [
        'url' => 'required|string|min:3|max:100',
        'target_url' => 'required|string|min:3|max:100',
        'related_model_id' => 'sometimes|min:1',
        'related_model_class' => 'sometimes|string|min:3|max:255'
    ];

    public function __construct(
        protected PermalinkRepository $permalinkRepository
    )
    {
    }

    public function createPermalink(array $attributes): Model
    {
        $validator = Validator::make($attributes, self::$createValidationRules);

        if ($validator->fails()) {
            throw new \InvalidArgumentException($validator->errors()->first());
        }

        return $this->permalinkRepository->create($attributes);
    }

    public function find(int|string $id): Model|null
    {
        return $this->permalinkRepository->find($id);
    }

    public function deletePermalink(Permalink $permalink)
    {
        $this->permalinkRepository->delete($permalink);
    }

    public function findByUrl(string $url): Model|null
    {
        return $this->permalinkRepository->findByUrl($url);
    }

    public function setUrlOfPermalink(Permalink $permalink, string $url)
    {
        $this->permalinkRepository->setUrl($permalink, $url);
    }

    public function getAllByModel(Model $model): Collection
    {
        return $this->permalinkRepository->getAllByModel($model);
    }
}