<?php

namespace Modules\Common\Services\Repositories;

use stdClass;
use Modules\Common\Models\Product;

class ProductRepo
{
    /**
     * Get popular products
     * used by calling static method and pass string time
     * In: [this-week, this-month, this-year ]
     *
     * @param  string $productTypeName
     * @param  string $time in [this-week, this-month, this-year]
     * @param  int $total
     * @return Modules\Common\Models\Product
     */
    public function getPopularproducts($total = 4)
    {
        $products = Product::query();
        $products->published();
        // ->where(function ($product) {
        //     $product->where('number_of_views', '>', 50)
        //         ->orWhere('number_of_shares', '>', 20);
        // });

        return $products->orderBy('number_of_views', 'desc')
            ->limit($total)->get();
    }

    /**
     * Find related product by the same tags
     *
     * @param  string $tags
     * @param  int $total
     * @return Modules\Common\Models\Product
     */
    public function relatedproducts(string $tags, $total = 5)
    {
        $products = Product::query()->published()
            ->where('tags', 'REGEXP', str_replace(',', '|', $tags));

        return $products->orderBy('published_at', 'desc')
            ->limit($total)->get();
    }

    /**
     * Get public products
     * Use by calling static method and pass the request on array
     *
     * @param  object $request [search, type, tag, category]
     * @param  int $total
     * @return Modules\Common\Models\product
     */
    public function getPublicproducts(object $request, $total = 10)
    {
        $products = Product::with('writer')->published();

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $products->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $products->category($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->tag)) {
            if ($request->tag) {
                $products->tag($request);
            }
        }

        // Get by writer
        if (isset($request->author)) {
            if ($request->author) {
                $products->orWherehas('writer', function ($query) use ($request) {
                    $query->where('email', $request->author);
                });
            }
        }

        // Get by date
        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $products->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }

            if (!$request->date_start && $request->date_end) {
                $products->whereDate('published_at', '<=', $request->date_end);
            }

            if ($request->date_start && !$request->date_end) {
                $products->whereDate('published_at', '>=', $request->date_start);
            }
        }

        if (isset($request->sort)) {
            $products->sort(self::switchSort($request->sort));
        };

        return $products->paginate($total);
    }

    /**
     * Get all products by choosen category
     *
     * @param  string $category
     * @param  boolean $paginated
     * @param  int $total
     * @param  string $subCategory
     * @return void
     */
    public function getByCategory($category, $paginated = false, $total = 6, $subCategory = null)
    {
        $products = Product::with('writer')
            ->published()
            ->category((object) [
                'category' => $category,
            ]);

        if ($subCategory) {
            $products->subcategory((object) [
                'subCategory' => $subCategory,
            ]);
        }

        if ($paginated) {
            return $products
                ->orderBy('published_at', 'desc')
                ->paginate($total);
        }

        return $products->limit($total)
            ->orderBy('published_at', 'desc')
            ->get();
    }

    /**
     * Get latest product from resource
     *
     * @param  int $total
     * @return Modules\Common\Models\Product
     */
    public function getLatestproducts($total = 5)
    {
        $products = Product::with('writer')->published();
        return $products->orderBy('published_at', 'desc')->paginate($total);
    }

    /**
     * Get latest product by choosen category
     *
     * @param  object $request
     * @param  int $total
     * @return Modules\Common\Models\product
     */
    public function getLatestproductsByCategory(object $request, $total = 5)
    {
        $products = product::with('writer')->published();

        if (isset($request->type)) {
            if ($request->type) {
                $products->type($request);
            }
        }

        if (isset($request->category)) {
            if ($request->category) {
                $products->category($request);
            }
        }

        return $products->orderBy('published_at', 'desc')->limit($total)->get();
    }

    /**
     * Get random product
     *
     * @param  string $exceptSlug
     * @param  string $type
     * @param  int $total
     * @return Modules\Common\Models\Product
     */
    public function getRandomproducts($exceptSlug = null, $type = null, $total = 5)
    {
        $products = Product::with('writer')->published();

        if ($type) {
            $products->type((object) [
                'type' => $type,
            ]);
        }

        if ($exceptSlug) {
            $products->where('slug_title', '!=', $exceptSlug);
        }

        return $products->inRandomOrder()->limit($total)->get();
    }


    public function showPublicproduct(string $slug_title, $is_publish = true)
    {
        $product = Product::query()
            ->where('slug_title', $slug_title);

        if ($is_publish) {
            $product->published();
        }

        return $product->firstOrFail();
    }


    public function filters(object $request, $total = 10, $paginated = true)
    {
        $products = Product::query()->with('category:id,name,slug',  'creator:id,name');

        // Check if props below is true/not empty
        if (isset($request->search)) {
            if ($request->search) {
                $products->search($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->category)) {
            if ($request->category) {
                $products->category($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->type)) {
            if ($request->type) {
                $products->type($request);
            }
        }

        // Check if props below is true/not empty
        if (isset($request->status)) {
            if ($request->status) {
                if ($request->status == 'published') {
                    $products->published();
                }
                if ($request->status == 'draft') {
                    $products->draft();
                }
                if ($request->status == 'archived') {
                    $products->archived();
                }
            }
        }

        // Check if props below is true/not empty
        if (isset($request->creator)) {
            if ($request->creator) {
                $products->where('created_by',  $request->creator);
            }
        }


        if (isset($request->user_id)) {
            if ($request->user_id != null) {
                $products->where('created_by',  $request->user_id);
            }
        }



        // Check if props below is true/not empty
        if (isset($request->author)) {
            if ($request->author) {
                $products->author($request);
            }
        }

        if (isset($request->date_start) && isset($request->date_end)) {
            if ($request->date_start && $request->date_end) {
                $products->whereBetween('published_at', [$request->date_start, $request->date_end]);
            }
        }

        if (!$paginated) {
            return $products->sort($request)->get();
        }

        return $products->sort($request)->paginate($total);
    }

    /**
     * product with not yes approved status
     *
     * @return Modules\Common\Models\Product
     */
    public function notYetApproved()
    {
        $products = Product::query()
            ->whereNull('approved_at');

        return $products->orderBy('created_at', 'desc')->get();
    }

    public function countproduct($closure)
    {
        $products = Product::query();
        return $products->count();
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
