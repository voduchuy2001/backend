<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
        'type',
        'title',
        'description',
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
}
