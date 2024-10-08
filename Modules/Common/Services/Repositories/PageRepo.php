<?php

namespace Modules\Common\Services\Repositories;

use Modules\Common\Models\Page;

class PageRepo
{
    /**
     * Get all pages data from resource
     * with specific request
     *
     * @param  object $request
     * @param  int $total
     * @return Illuminate\Contracts\Pagination\Paginator
     */
    public function filters(object $request, $total = 10)
    {
        $pages = Page::query();

        if (isset($request->search)) {
            if ($request->search) {
                $pages->search($request);
            }
        }

        if (isset($request->onlyTrashed)) {
            if ($request->onlyTrashed) {
                $pages->onlyTrashed();
            }
        }

        return $pages->sort($request)->paginate($total);
    }
}
