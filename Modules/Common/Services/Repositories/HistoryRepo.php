<?php

namespace Modules\Common\Services\Repositories;

use stdClass;
use Modules\Common\Models\History;

class HistoryRepo
{
    /**
     * Get popular Historys
     * used by calling static method and pass string time
     * In: [this-week, this-month, this-year ]
     *
     * @param  string $historyTypeName
     * @param  string $time in [this-week, this-month, this-year]
     * @param  int $total
     * @return Modules\Common\Models\History
     */
    public function getPopularHistorys($total = 4)
    {
        $historys = History::query();
        $historys->published();
        // ->where(function ($history) {
        //     $history->where('number_of_views', '>', 50)
        //         ->orWhere('number_of_shares', '>', 20);
        // });

        return $historys->orderBy('number_of_views', 'desc')
            ->limit($total)->get();
    }

    /**
     * Find related History by the same tags
     *
     * @param  string $tags
     * @param  int $total
     * @return Modules\Common\Models\History
     */
    public function relatedHistorys(string $tags, $total = 5)
    {
        $historys = History::query()->published()
            ->where('tags', 'REGEXP', str_replace(',', '|', $tags));

        return $historys->orderBy('published_at', 'desc')
            ->limit($total)->get();
    }

    /**
     * Get public Historys
     * Use by calling static method and pass the request on array
     *
     * @param  object $request [search, type, tag, category]
     * @param  int $total
     * @return Modules\Common\Models\History
     */
    public function getPublicHistorys(object $request, $total = 10)
    {
        $historys = History::with('writer')->published();

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $historys->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $historys->category($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->tag)) {
            if ($request->tag) {
                $historys->tag($request);
            }
        }

        // Get by writer
        if (isset($request->author)) {
            if ($request->author) {
                $historys->orWherehas('writer', function ($query) use ($request) {
                    $query->where('email', $request->author);
                });
            }
        }

        // Get by date
        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $historys->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }

            if (!$request->date_start && $request->date_end) {
                $historys->whereDate('published_at', '<=', $request->date_end);
            }

            if ($request->date_start && !$request->date_end) {
                $historys->whereDate('published_at', '>=', $request->date_start);
            }
        }

        if (isset($request->sort)) {
            $historys->sort(self::switchSort($request->sort));
        };

        return $historys->paginate($total);
    }

    /**
     * Get all Historys by choosen category
     *
     * @param  string $category
     * @param  boolean $paginated
     * @param  int $total
     * @param  string $subCategory
     * @return void
     */
    public function getByCategory($category, $paginated = false, $total = 6, $subCategory = null)
    {
        $historys = History::with('writer')
            ->published()
            ->category((object) [
                'category' => $category,
            ]);

        if ($subCategory) {
            $historys->subcategory((object) [
                'subCategory' => $subCategory,
            ]);
        }

        if ($paginated) {
            return $historys
                ->orderBy('published_at', 'desc')
                ->paginate($total);
        }

        return $historys->limit($total)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * Get latest History from resource
     *
     * @param  int $total
     * @return Modules\Common\Models\History
     */
    public function getLatestHistorys($total = 5)
    {
        $historys = History::with('writer')->published();
        return $historys->orderBy('published_at', 'desc')->paginate($total);
    }

    /**
     * Get latest History by choosen category
     *
     * @param  object $request
     * @param  int $total
     * @return Modules\Common\Models\History
     */
    public function getLatestHistorysByCategory(object $request, $total = 5)
    {
        $historys = History::with('writer')->published();

        if (isset($request->type)) {
            if ($request->type) {
                $historys->type($request);
            }
        }

        if (isset($request->category)) {
            if ($request->category) {
                $historys->category($request);
            }
        }

        return $historys->orderBy('published_at', 'desc')->limit($total)->get();
    }

    /**
     * Get random History
     *
     * @param  string $exceptSlug
     * @param  string $type
     * @param  int $total
     * @return Modules\Common\Models\History
     */
    public function getRandomHistorys($exceptSlug = null, $type = null, $total = 5)
    {
        $historys = History::with('writer')->published();

        if ($type) {
            $historys->type((object) [
                'type' => $type,
            ]);
        }

        if ($exceptSlug) {
            $historys->where('slug_title', '!=', $exceptSlug);
        }

        return $historys->inRandomOrder()->limit($total)->get();
    }


    public function showPublicHistory(string $slug_title, $is_publish = true)
    {
        $history = History::query()
            ->where('slug_title', $slug_title);

        if ($is_publish) {
            $history->published();
        }

        return $history->firstOrFail();
    }


    public function filters(object $request, $total = 10, $paginated = true)
    {
        $historys = History::query()->with('partner:id,name');

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $historys->search($request);
            }
        }


        if (isset($request->user)) {
            if ($request->user) {
                $historys->orWherehas('partner', function ($query) use ($request) {
                    $query->where('name', $request->partner);
                });
            }
        }


      
         // Check if props below is true/not empty
         if (isset($request->partner)) {
            if ($request->partner) {
                $historys->orWherehas('partner', function ($query) use ($request) {
                    $query->where('name', $request->partner);
                });
        
            }
        }


        // Check if props below is true/not empty
        if (isset($request->type)) {
            if ($request->type) {
                $historys->type($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->status)) {
            if ($request->status) {
                if ($request->status == 'active') {
                    $historys->where('status',  "active");
                }
                if ($request->status == 'pending') {
                    $historys->where('status',  "pending");
                }
                if ($request->status == 'hold') {
                    $historys->where('status',  "hold");
                }
            }
        }

       

        // Check if props below is true/not empty
        if (isset($request->author)) {
            if ($request->author) {
                $historys->author($request);
            }
        }

        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $historys->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }
        }

        if (!$paginated) {
            return $historys->sort($request)->get();
        }

        return $historys->sort($request)->paginate($total);
    }

    /**
     * History with not yes approved status
     *
     * @return Modules\Common\Models\History
     */
    public function notYetApproved()
    {
        $historys = History::query()
            ->whereNull('approved_at');

        return $historys->orderBy('created_at', 'desc')->get();
    }

    public function countHistory($closure)
    {
        $historys = History::query();
        return $historys->count();
    }


    public function switchSort($request)
    {
        $response = new stdClass;
        switch ($request) {
            case 'title-a-z':
                $response->sort = 'title';
                $response->order = 'asc';
                return $response;
                break;

            case 'title-z-a':
                $response->sort = 'title';
                $response->order = 'desc';
                return $response;
                break;

            case 'newest':
            $response->sort = 'created_at';
                $response->order = 'desc';
                return $response;
                break;

            case 'oldest':
                $response->sort = 'created_at';
                $response->order = 'asc';
                return $response;
                break;

            default:
                $response->sort = 'created_at';
                $response->order = 'desc';
                return $response;
                break;
        }
    }
}
