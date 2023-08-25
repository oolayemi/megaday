<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'condition' => ['required', Rule::in(['new', 'used'])],
            'location_city' => ['required', 'string'],
            'location_state' => ['required', 'string'],
            'location_country' => ['required', 'string'],
            'images' => ['required', 'array'],
            'images.*' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'video' => ['nullable', 'mimetypes:video/mp4,video/mpeg,video/quicktime', 'max:20480'],
        ];
    }
}
