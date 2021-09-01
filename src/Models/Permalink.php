<?php

namespace Latus\Permalink\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Permalink extends Model
{
    protected $fillable = [
        "url", "target_url", "related_model_id", "related_model_class",
    ];

    public function relatedModel(): BelongsTo
    {
        return $this->belongsTo($this->related_model_class, $this->related_model_id);
    }
}