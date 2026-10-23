<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return ProductResource::collection($products);
    }

    // POST /api/products
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'desc'        => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price'       => 'required|numeric',
            'stock'       => 'nullable|integer',
            'img'         => 'nullable',
            'image'       => 'nullable|string',
        ]);

        $description = $request->desc ?? ($request->description ?? null);

        // Upload file gambar ke storage public jika ada
        $path = null;
        if ($request->hasFile('img')) {
            $path = $request->file('img')->store('products', 'public');
        } elseif ($request->filled('img')) {
            $path = $request->img;
        } elseif ($request->filled('image')) {
            $path = $request->image;
        }

        // Generate slug unik
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $count = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $product = Product::create([
            'name'        => $request->name,
            'artist'      => $request->artist ?? null,
            'format'      => $request->format ?? null,
            'description' => $description,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'stock'       => $request->stock ?? 0,
            'img'         => $path,
            'slug'        => $slug,
        ]);

        return new ProductResource($product);
    }

    // GET /api/products/{id}
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return new ProductResource($product);
    }

    // PUT /api/products/{id}
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'desc'        => 'nullable|string',
            'category_id' => 'required|exists:categories,category_id',
            'price'       => 'required|numeric',
            'stock'       => 'nullable|integer',
            'img'         => 'nullable',
            'image'       => 'nullable|string',
        ]);

        $description = $request->desc ?? ($request->description ?? $product->description);
        $path = $product->img;

        // Ganti file di storage jika ada upload baru
        if ($request->hasFile('img')) {
            if ($product->img && !Str::startsWith($product->img, 'http') && Storage::disk('public')->exists($product->img)) {
                Storage::disk('public')->delete($product->img);
            }
            $path = $request->file('img')->store('products', 'public');
        } elseif ($request->filled('img')) {
            $path = $request->img;
        } elseif ($request->filled('image')) {
            $path = $request->image;
        }

        // Update slug unik jika nama berubah
        $baseSlug = Str::slug($request->name);
        $slug = $baseSlug;
        $count = 1;
        while (Product::where('slug', $slug)->where('product_id', '!=', $product->product_id)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        $product->update([
            'name'        => $request->name,
            'artist'      => $request->artist ?? $product->artist,
            'format'      => $request->format ?? $product->format,
            'description' => $description,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'stock'       => $request->stock ?? $product->stock,
            'img'         => $path,
            'slug'        => $slug,
        ]);

        return new ProductResource($product);
    }

    // DELETE /api/products/{id}
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product != null) {
            if ($product->img && !Str::startsWith($product->img, 'http') && Storage::disk('public')->exists($product->img)) {
                Storage::disk('public')->delete($product->img);
            }
            $product->delete();

            return response()->json([
                'message' => 'Product deleted successfully',
            ]);
        }

        return response()->json([
            'message' => 'Product not found',
        ], 404);
    }
}
