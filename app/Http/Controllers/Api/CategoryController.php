<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = Category::query()
            ->select(['id', 'name', 'description', 'image_url'])
            ->isAvailable()
            ->get();

        return ApiResponse::success('Categories retrieved successfully', $categories->toArray());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file|max:1024|mime',
        ]);

        unset($validated['image']);

        Category::query()->create($validated);

        return ApiResponse::success('Categories added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::query()
            ->select(['id', 'name', 'description', 'image_url', 'is_available'])
            ->find($id);

        return ApiResponse::success('Category retrieved successfully', $category->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file|max:1024|mime',
        ]);

        unset($validated['image']);
        $category = Category::find($id);
        if (! $category) {
            return ApiResponse::failed('The selected category cannot be found');
        }

        $category->update($validated);
        return ApiResponse::success('Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $category = Category::query()->find($id);
        if (! $category?->exists()) {
            return ApiResponse::failed('The selected category cannot be found');
        }

        $category->delete();
        return ApiResponse::success('Category deleted successfully');
    }
}
