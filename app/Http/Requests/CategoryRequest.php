<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'name')->ignore($this->category)
            ],
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:10000'
        ];

        // Nếu là store (tạo mới), ảnh là bắt buộc
        if ($this->isMethod('post')) {
            $rules['avatar'] = 'required|image|mimes:jpg,jpeg,png|max:10000';
        }

        return $rules;
    }

    /**
     * Xử lý upload ảnh (nếu có)
     */
    public function getImage()
    {
        $data = $this->validated();

        if ($this->hasFile('avatar')) { 
            $data['avatar'] = $this->file('avatar')->store('categories', 'public'); 
        }

        return $data;
    }

    /**
     * Custom messages for validation
     */
    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.string' => 'Tên danh mục phải là chuỗi.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'name.unique' => 'Danh mục này đã tồn tại.',

            'avatar.required' => 'Ảnh danh mục là bắt buộc khi tạo mới.',
            'avatar.image' => 'Tệp tải lên phải là một hình ảnh.',
            'avatar.mimes' => 'Ảnh danh mục chỉ được có định dạng jpg, jpeg, png.',
            'avatar.max' => 'Ảnh danh mục không được vượt quá 10MB.'
        ];
    }
}
