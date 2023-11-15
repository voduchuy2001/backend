<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function getAllDescendantsAndSelf()
    {
        $descendants = collect([$this]);

        $children = $this->children;

        foreach ($children as $child) {
            $descendants = $descendants->concat($child->getAllDescendantsAndSelf());
            $descendants = $descendants->reject(function ($item) use ($child) {
                return $item->id === $child->id;
            });
        }

        return $descendants;
    }
}
