<?php

namespace App\Http\Controllers;

use Modules\Common\Models\Category;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::where('group', 'products')->get();
        return response()->json($category);
    }

    public function indexRetribution()
    {
        $category = Category::where('group', 'retribution')->get();
        return response()->json($category);
    }

    public function retribution($id)
    {
        $category = Category::with(['retributions' => function($query) {
            $query->select('category_id', DB::raw('SUM(nominal) as total_nominal'), DB::raw('SUM(number_of_days) as total_days'))
                  ->where('is_active', '1') // Filter for active retributions
                  ->groupBy('category_id');
        }])->findOrFail($id);
    
        // Cek apakah retributions ada
        if ($category->retributions->isEmpty()) {
            return response()->json(['message' => 'No retributions found for this category'], 404);
        }
    
        return response()->json($category);
    }
    



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        // Generate the slug from the name
        $slug = Str::slug($request->name);

        // Check if the generated slug is unique, otherwise append a number to make it unique
        $existingSlugCount = Category::where('slug', 'like', $slug . '%')->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }


        $data = [
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id ?: null,
            'is_featured' => $request->is_featured ? 1 : 0,
            'group' => 'products',
            'created_by' => $request->user()->id,
        ];

        try {

            $category = Category::create($data);

            return response()->json(['message' => 'Category created successfully.', 'data' => $category], 201);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $slug = Str::slug($request->name);

        // Check if the generated slug is unique, otherwise append a number to make it unique
        $existingSlugCount = Category::where('slug', 'like', $slug . '%')->count();
        if ($existingSlugCount > 0) {
            $slug .= '-' . ($existingSlugCount + 1);
        }


        $data = [
            'name' => $request->name,
            // 'slug' => $request->slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id ?: null,
            'status' => $request->status ? 1 : 0,
            'is_featured' => $request->is_featured ? 1 : 0,
            'created_by' => $request->user()->id,
        ];

        try {

            $category->update($data);

            return response()->json(['message' => 'Category updated successfully.', 'data' => $category]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        try {
            $category->delete();

            return response()->json(['message' => 'Category deleted successfully.']);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return response()->json(['data' => $category]);
    }
}
