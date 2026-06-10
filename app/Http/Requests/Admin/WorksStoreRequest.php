<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class WorksStoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'link'        => 'required|string|max:255',
            'tags'        => 'nullable|string',   // comma-separated → tecknicals
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'       => 'Title is required',
            'description.required' => 'Description is required',
            'image.required'       => 'Image is required',
            'link.required'        => 'Project URL is required',
        ];
    }
}
