<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Common\Models\Product;
use Modules\Common\Models\Transaction;
use Modules\Common\Models\TransactionDetail;
use Modules\Common\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;




class ProductController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 12); 

        $products = Product::paginate($perPage);

        return response()->json($products);
    }


    public function category()
    {
        $category = Category::where('group', 'products')->get();
        return response()->json($category);
    }

    public function checkout(Request $request)
    {
        // Validate the request data
        Log::info($request->all());

        $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'total_amount' => 'required|numeric',
            'transaction_details' => 'required|array',
            'transaction_details.*.product_id' => 'required|exists:products,id',
            'transaction_details.*.quantity' => 'required|integer|min:1',
            'transaction_details.*.price' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            // Create a new transaction
            $transaction = Transaction::create([
                'partner_id' => $request->partner_id,
                'total_amount' => $request->total_amount,
                'transaction_date' => now(), // or any specific date
                'value' => $request->total_amount, // assuming value is the same as total_amount
                'change_amount' => $request->change, // calculate if necessary
                'payment_method' => $request->payment_method,
            ]);

            // Loop through transaction details and save them
            foreach ($request->transaction_details as $detail) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $detail['product_id'],
                    'quantity' => $detail['quantity'],
                    'price' => $detail['price'],
                    'subtotal' => $detail['quantity'] * $detail['price'],
                    'transaction_date' => now(), // or any specific date
                ]);
            }

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Transaksi Berhasil', 'transaction_id' => $transaction->id], 201);
        } catch (\Exception $e) {
            // Rollback the transaction in case of error
            DB::rollback();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048', // Validate image
            'publish' => 'boolean',
        ]);

        try {
            // Generate slug from title
            $slugTitle = Str::slug($request->input('title'));

            // Ensure slug is unique
            $existingSlugCount = Product::where('slug_title', 'like', "{$slugTitle}%")->count();
            if ($existingSlugCount > 0) {
                $slugTitle .= '-' . ($existingSlugCount + 1); // Append number for uniqueness
            }

            $data = [
                'id' => Product::generateId(),
                'title' => $request->input('title'),
                'slug_title' => $slugTitle,
                'category_id' => $request->input('category_id'),
                'type' => $request->input('type'),
                'description' => $request->input('description'),
                'tags' => $request->input('tags'),
                'price' => $request->input('price'),
                'created_by' => auth()->user()->id, // Get user ID from authentication
            ];

            // Handle publication
            if ($request->input('publish', false)) {
                $data['published_by'] = auth()->user()->id;
                $data['published_at'] = now()->toDateTimeString();
                $data['archived_at'] = null;
            } else {
                $data['published_at'] = null;
                $data['archived_at'] = null;
            }

            // Handle image upload
            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');

                // Define the directory structure
                $dateFolder = now()->format('Y-m-d');

                // Generate a unique filename
                $filename = Str::random(12) . '.' . $image->getClientOriginalExtension();

                // Store the image in the desired folder with the custom filename
                $imagePath = $image->storeAs("images/{$dateFolder}", $filename, 'public');

                // Save the full path
                $data['thumbnail'] = '/storage/' . $imagePath;
            }


            // Save product
            $product = Product::create($data);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Product successfully added.',
                'product' => $product
            ], 201); // Created

        } catch (\Exception $exception) {
            // Handle exception and return error
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 500); // Internal Server Error
        }
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'tags' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:6048', // Validate image
            'publish' => 'boolean',
        ]);

        try {
            // Find the product
            $product = Product::findOrFail($id);

            // Generate slug from title
            $slugTitle = Str::slug($request->input('title'));

            // Ensure slug is unique
            $existingSlugCount = Product::where('slug_title', 'like', "{$slugTitle}%")
                ->where('id', '!=', $id) // Exclude the current product
                ->count();
            if ($existingSlugCount > 0) {
                $slugTitle .= '-' . ($existingSlugCount + 1); // Append number for uniqueness
            }

            $data = [
                'title' => $request->input('title'),
                'slug_title' => $slugTitle,
                'category_id' => $request->input('category_id'),
                'type' => $request->input('type'),
                'description' => $request->input('description'),
                'tags' => $request->input('tags'),
                'price' => $request->input('price'),
            ];

            // Handle publication
            if ($request->input('publish', false)) {
                $data['published_by'] = auth()->user()->id;
                $data['published_at'] = now()->toDateTimeString();
                $data['archived_at'] = null;
            } else {
                $data['published_at'] = null;
                $data['archived_at'] = null;
            }

            // Handle image upload
            if ($request->hasFile('thumbnail')) {
                // Delete the old image if it exists
                if ($product->thumbnail) {
                    Storage::disk('public')->delete($product->thumbnail);
                }

                $image = $request->file('thumbnail');


                $dateFolder = now()->format('Y-m-d');

                // Generate a unique filename
                $filename = Str::random(12) . '.' . $image->getClientOriginalExtension();

                // Store the image in the desired folder with the custom filename
                $imagePath = $image->storeAs("images/{$dateFolder}", $filename, 'public');

                // Save the full path
                $data['thumbnail'] = '/storage/' . $imagePath;
            }

            // Update product
            $product->update($data);

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Product successfully updated.',
                'product' => $product
            ], 200); // OK

        } catch (\Exception $exception) {
            // Handle exception and return error
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 500); // Internal Server Error
        }
    }

    public function destroy($id)
    {
        try {
            // Find the product
            $product = Product::findOrFail($id);

            // Delete the image file if it exists
            if ($product->thumbnail) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            // Delete product
            $product->delete();

            // Return success response
            return response()->json([
                'status' => 'success',
                'message' => 'Product successfully deleted.'
            ], 200); // OK

        } catch (\Exception $exception) {
            // Handle exception and return error
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 500); // Internal Server Error
        }
    }

    public function edit($id)
    {
        $category = Product::where('id', $id)->firstOrFail();;

        return response()->json(['data' => $category]);
    }
}
