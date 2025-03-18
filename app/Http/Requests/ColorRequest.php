<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:colors,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Màu sắc là bắt buộc.',
            'name.max' => 'Màu sắc không được vượt quá 255 ký tự.',
            'name.unique' => 'Màu sắc này đã tồn tại.',
        ];
    }
}
