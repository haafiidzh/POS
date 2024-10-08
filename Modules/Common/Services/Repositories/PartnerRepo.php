<?php

namespace Modules\Common\Services\Repositories;

use stdClass;
use Modules\Common\Models\Partner;

class PartnerRepo
{
    /**
     * Get popular Partners
     * used by calling static method and pass string time
     * In: [this-week, this-month, this-year ]
     *
     * @param  string $partnerTypeName
     * @param  string $time in [this-week, this-month, this-year]
     * @param  int $total
     * @return Modules\Common\Models\Partner
     */
    public function getPopularPartners($total = 4)
    {
        $partners = Partner::query();
        $partners->published();
        // ->where(function ($partner) {
        //     $partner->where('number_of_views', '>', 50)
        //         ->orWhere('number_of_shares', '>', 20);
        // });

        return $partners->orderBy('number_of_views', 'desc')
            ->limit($total)->get();
    }

    /**
     * Find related Partner by the same tags
     *
     * @param  string $tags
     * @param  int $total
     * @return Modules\Common\Models\Partner
     */
    public function relatedPartners(string $tags, $total = 5)
    {
        $partners = Partner::query()->published()
            ->where('tags', 'REGEXP', str_replace(',', '|', $tags));

        return $partners->orderBy('published_at', 'desc')
            ->limit($total)->get();
    }

    /**
     * Get public Partners
     * Use by calling static method and pass the request on array
     *
     * @param  object $request [search, type, tag, category]
     * @param  int $total
     * @return Modules\Common\Models\Partner
     */
    public function getPublicPartners(object $request, $total = 10)
    {
        $partners = Partner::with('writer')->published();

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $partners->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $partners->category($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->tag)) {
            if ($request->tag) {
                $partners->tag($request);
            }
        }

        // Get by writer
        if (isset($request->author)) {
            if ($request->author) {
                $partners->orWherehas('writer', function ($query) use ($request) {
                    $query->where('email', $request->author);
                });
            }
        }

        // Get by date
        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $partners->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }

            if (!$request->date_start && $request->date_end) {
                $partners->whereDate('published_at', '<=', $request->date_end);
            }

            if ($request->date_start && !$request->date_end) {
                $partners->whereDate('published_at', '>=', $request->date_start);
            }
        }

        if (isset($request->sort)) {
            $partners->sort(self::switchSort($request->sort));
        };

        return $partners->paginate($total);
    }

    /**
     * Get all Partners by choosen category
     *
     * @param  string $category
     * @param  boolean $paginated
     * @param  int $total
     * @param  string $subCategory
     * @return void
     */
    public function getByCategory($category, $paginated = false, $total = 6, $subCategory = null)
    {
        $partners = Partner::with('writer')
            ->published()
            ->category((object) [
                'category' => $category,
            ]);

        if ($subCategory) {
            $partners->subcategory((object) [
                'subCategory' => $subCategory,
            ]);
        }

        if ($paginated) {
            return $partners
                ->orderBy('published_at', 'desc')
                ->paginate($total);
        }

        return $partners->limit($total)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * Get latest Partner from resource
     *
     * @param  int $total
     * @return Modules\Common\Models\Partner
     */
    public function getLatestPartners($total = 5)
    {
        $partners = Partner::with('writer')->published();
        return $partners->orderBy('published_at', 'desc')->paginate($total);
    }

    /**
     * Get latest Partner by choosen category
     *
     * @param  object $request
     * @param  int $total
     * @return Modules\Common\Models\Partner
     */
    public function getLatestPartnersByCategory(object $request, $total = 5)
    {
        $partners = Partner::with('writer')->published();

        if (isset($request->type)) {
            if ($request->type) {
                $partners->type($request);
            }
        }

        if (isset($request->category)) {
            if ($request->category) {
                $partners->category($request);
            }
        }

        return $partners->orderBy('published_at', 'desc')->limit($total)->get();
    }

    /**
     * Get random Partner
     *
     * @param  string $exceptSlug
     * @param  string $type
     * @param  int $total
     * @return Modules\Common\Models\Partner
     */
    public function getRandomPartners($exceptSlug = null, $type = null, $total = 5)
    {
        $partners = Partner::with('writer')->published();

        if ($type) {
            $partners->type((object) [
                'type' => $type,
            ]);
        }

        if ($exceptSlug) {
            $partners->where('slug_title', '!=', $exceptSlug);
        }

        return $partners->inRandomOrder()->limit($total)->get();
    }


    public function showPublicPartner(string $slug_title, $is_publish = true)
    {
        $partner = Partner::query()
            ->where('slug_title', $slug_title);

        if ($is_publish) {
            $partner->published();
        }

        return $partner->firstOrFail();
    }


    public function filters(object $request, $total = 10, $paginated = true)
    {
        $partners = Partner::query()->with('category:id,name,slug', 'user:id,name,email', 'editor:id,name,email');

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $partners->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $partners->category($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->type)) {
            if ($request->type) {
                $partners->type($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->status)) {
            if ($request->status) {
                if ($request->status == 'active') {
                    $partners->where('status',  "active");
                }
                if ($request->status == 'pending') {
                    $partners->where('status',  "pending");
                }
                if ($request->status == 'hold') {
                    $partners->where('status',  "hold");
                }
            }
        }

       

        // Check if props below is true/not empty
        if (isset($request->author)) {
            if ($request->author) {
                $partners->author($request);
            }
        }

        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $partners->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }
        }

        if (!$paginated) {
            return $partners->sort($request)->get();
        }

        return $partners->sort($request)->paginate($total);
    }

    /**
     * Partner with not yes approved status
     *
     * @return Modules\Common\Models\Partner
     */
    public function notYetApproved()
    {
        $partners = Partner::query()
            ->whereNull('approved_at');

        return $partners->orderBy('created_at', 'desc')->get();
    }

    public function countPartner($closure)
    {
        $partners = Partner::query();
        return $partners->count();
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
