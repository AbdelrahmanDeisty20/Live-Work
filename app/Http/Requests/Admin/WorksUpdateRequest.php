<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WorksUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'          => 'required|exists:works,id',
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'link'        => 'required|string|max:255',
            'tags'        => 'nullable|string',   // comma-separated → tecknicals
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'          => 'Work ID is required',
            'id.exists'            => 'Work not found',
            'title.required'       => 'Title is required',
            'description.required' => 'Description is required',
            'url.required'         => 'URL is required',
            'tags.required'        => 'Tags are required',
        ];
    }
}
