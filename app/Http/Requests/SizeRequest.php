<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SizeRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:sizes,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kích cỡ là bắt buộc.',
            'name.max' => 'Kích cỡ không được vượt quá 255 ký tự.',
            'name.unique' => 'Kích cỡ này đã tồn tại.',
        ];
    }
}
