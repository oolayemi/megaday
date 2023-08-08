<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $categories = SubCategory::query()
            ->with('category:id,name,description,image_url')
            ->select(['id', 'category_id', 'name', 'description', 'image_url'])
            ->isAvailable()
            ->get();

        return ApiResponse::success('Sub categories retrieved successfully', $categories->toArray());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|file|max:1024|mime',
        ]);

        unset($validated['image']);

        SubCategory::query()->create($validated);
        return ApiResponse::success('Sub categories added successfully');
    }

    public function show(string $id): JsonResponse
    {
        $subCategory = SubCategory::query()
            ->with('category:id,name,description,image_url')
            ->select(['id', 'category_id', 'name', 'description', 'image_url', 'is_available'])
            ->find($id);

        if (! $subCategory) {
            return ApiResponse::failed('The selected sub category cannot be found');
        }

        return ApiResponse::success('Sub category retrieved successfully', $subCategory->toArray());
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
        $subCategory = SubCategory::find($id);
        if (! $subCategory) {
            return ApiResponse::failed('The selected sub category cannot be found');
        }

        $subCategory->update($validated);
        return ApiResponse::success('Sub category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $subCategory = SubCategory::query()->find($id);
        if (! $subCategory?->exists()) {
            return ApiResponse::failed('The selected sub category cannot be found');
        }

        $subCategory->delete();
        return ApiResponse::success('Sub category deleted successfully');
    }
}
