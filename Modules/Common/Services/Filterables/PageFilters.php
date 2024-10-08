<?php

namespace Modules\Common\Services\Filterables;

trait PageFilters
{
    /**
     * Handle search query in the Page Table
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  object $request
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $request)
    {
        if (isset($request->search)) {
            return $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('short_description', 'like', '%' . $request->search . '%');
        }

        return $query;
    }
}
