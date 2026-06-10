<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PageUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'    => 'required|exists:pages,id',
            'key'   => 'required|string|max:255',
            'type'  => 'required|string|in:text,image,textarea',
            'value' => $this->input('type') === 'image'
                ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096'
                : 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'key.required' => 'Key is required',
            'value.required' => 'Value is required',
        ];
    }
}
