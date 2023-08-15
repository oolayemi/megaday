<?php

namespace App\Http\Requests;

use App\Services\Enums\ProductConditionEnum;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'sub_category_id' => ['required', 'exists:sub_categories,id'],
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'quantity' => ['required', 'integer'],
            'price' => ['required', 'decimal:0,2'],
            'discount' => ['nullable', 'decimal:0,2'],
            'is_negotiable' => ['required', 'boolean'],
            'condition' => ['required', new Enum(ProductConditionEnum::class)],
            'location.city' => ['required', 'string'],
            'location.state' => ['required', 'string'],
            'location.country' => ['required', 'string'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'video' => ['nullable', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:20480'],
        ];
    }
}
