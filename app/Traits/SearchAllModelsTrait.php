<?php

namespace App\Traits;


trait SearchAllModelsTrait {
    // scope to return search

    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', '%' . $search . '%');
        });
    }
}
