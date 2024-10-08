<?php

namespace Modules\Common\Services\Repositories;

use stdClass;
use Modules\Common\Models\Retribution;

class RetributionRepo
{
    /**
     * Get popular Retributions
     * used by calling static method and pass string time
     * In: [this-week, this-month, this-year ]
     *
     * @param  string $RetributionTypeName
     * @param  string $time in [this-week, this-month, this-year]
     * @param  int $total
     * @return Modules\Common\Models\Retribution
     */
    public function getPopularRetributions($total = 4)
    {
        $retributions = Retribution::query();
        $retributions->published();
        // ->where(function ($Retribution) {
        //     $Retribution->where('number_of_views', '>', 50)
        //         ->orWhere('number_of_shares', '>', 20);
        // });

        return $retributions->orderBy('number_of_views', 'desc')
            ->limit($total)->get();
    }

    /**
     * Find related Retribution by the same tags
     *
     * @param  string $tags
     * @param  int $total
     * @return Modules\Common\Models\Retribution
     */
    public function relatedRetributions(string $tags, $total = 5)
    {
        $retributions = Retribution::query()->published()
            ->where('tags', 'REGEXP', str_replace(',', '|', $tags));

        return $retributions->orderBy('published_at', 'desc')
            ->limit($total)->get();
    }

    /**
     * Get public Retributions
     * Use by calling static method and pass the request on array
     *
     * @param  object $request [search, type, tag, category]
     * @param  int $total
     * @return Modules\Common\Models\Retribution
     */
    public function getPublicRetributions(object $request, $total = 10)
    {
        $retributions = Retribution::with('writer')->published();

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $retributions->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $retributions->category($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->tag)) {
            if ($request->tag) {
                $retributions->tag($request);
            }
        }

        // Get by writer
        if (isset($request->author)) {
            if ($request->author) {
                $retributions->orWherehas('writer', function ($query) use ($request) {
                    $query->where('email', $request->author);
                });
            }
        }

        // Get by date
        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $retributions->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }

            if (!$request->date_start && $request->date_end) {
                $retributions->whereDate('published_at', '<=', $request->date_end);
            }

            if ($request->date_start && !$request->date_end) {
                $retributions->whereDate('published_at', '>=', $request->date_start);
            }
        }

        if (isset($request->sort)) {
            $retributions->sort(self::switchSort($request->sort));
        };

        return $retributions->paginate($total);
    }

    /**
     * Get all Retributions by choosen category
     *
     * @param  string $category
     * @param  boolean $paginated
     * @param  int $total
     * @param  string $subCategory
     * @return void
     */
    public function getByCategory($category, $paginated = false, $total = 6, $subCategory = null)
    {
        $retributions = Retribution::with('writer')
            ->published()
            ->category((object) [
                'category' => $category,
            ]);

        if ($subCategory) {
            $retributions->subcategory((object) [
                'subCategory' => $subCategory,
            ]);
        }

        if ($paginated) {
            return $retributions
                ->orderBy('published_at', 'desc')
                ->paginate($total);
        }

        return $retributions->limit($total)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * Get latest Retribution from resource
     *
     * @param  int $total
     * @return Modules\Common\Models\Retribution
     */
    public function getLatestRetributions($total = 5)
    {
        $retributions = Retribution::with('writer')->published();
        return $retributions->orderBy('published_at', 'desc')->paginate($total);
    }

    /**
     * Get latest Retribution by choosen category
     *
     * @param  object $request
     * @param  int $total
     * @return Modules\Common\Models\Retribution
     */
    public function getLatestRetributionsByCategory(object $request, $total = 5)
    {
        $retributions = Retribution::with('writer')->published();

        if (isset($request->type)) {
            if ($request->type) {
                $retributions->type($request);
            }
        }

        if (isset($request->category)) {
            if ($request->category) {
                $retributions->category($request);
            }
        }

        return $retributions->orderBy('published_at', 'desc')->limit($total)->get();
    }

    /**
     * Get random Retribution
     *
     * @param  string $exceptSlug
     * @param  string $type
     * @param  int $total
     * @return Modules\Common\Models\Retribution
     */
    public function getRandomRetributions($exceptSlug = null, $type = null, $total = 5)
    {
        $retributions = Retribution::with('writer')->published();

        if ($type) {
            $retributions->type((object) [
                'type' => $type,
            ]);
        }

        if ($exceptSlug) {
            $retributions->where('slug_title', '!=', $exceptSlug);
        }

        return $retributions->inRandomOrder()->limit($total)->get();
    }


    public function showPublicRetribution(string $slug_title, $is_publish = true)
    {
        $Retribution = Retribution::query()
            ->where('slug_title', $slug_title);

        if ($is_publish) {
            $Retribution->published();
        }

        return $Retribution->firstOrFail();
    }


    public function filters(object $request, $total = 10, $paginated = true)
    {
        $retributions = Retribution::query()->with('category:id,name,slug');

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $retributions->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $retributions->category($request);
            }
        }



        // Check if props below is true/not empty
        if (isset($request->status)) {
            if ($request->status) {
                if ($request->status == 'published') {
                    $retributions->where('is_active', 1);
                }else{
                    $retributions->where('is_active', 0);
                }
            }
        }


        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $retributions->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }
        }

        if (!$paginated) {
            return $retributions->sort($request)->get();
        }

        return $retributions->sort($request)->paginate($total);
    }

    /**
     * Retribution with not yes approved status
     *
     * @return Modules\Common\Models\Retribution
     */
    public function notYetApproved()
    {
        $retributions = Retribution::query()
            ->whereNull('approved_at');

        return $retributions->orderBy('created_at', 'desc')->get();
    }

    public function countRetribution($closure)
    {
        $retributions = Retribution::query();
        return $retributions->count();
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
