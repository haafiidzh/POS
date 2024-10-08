<?php

namespace Modules\Common\Services\Filterables;

trait SalesFilters
{      
    /**
     * Handle search query in the User Table
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  object $request
     * @return void
     */
    public function scopeSearch($query, $request)
    {
        if (isset($request->search) && $request->search) {
            return $query->where('id', 'like', "%{$request->search}%")
                         ->orWhere('total_amount', 'like', "%{$request->search}%")
                         ->orWhereHas('partner', function ($query) use ($request) {
                             $query->where('name', 'like', "%{$request->search}%");
                         });
        }
        
        return $query;
    }
}
