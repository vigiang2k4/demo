<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'name' => 'required|string|max:255|unique:categories,name',
            'avatar' => 'required|image|mimes:jpg,jpeg,png|max:10000'
        ];
    }

    public function getImage()
    {
        $data = $this->validated();

        if ($this->hasFile('avatar')) { 
            $data['avatar'] = $this->file('avatar')->store('categories', 'public'); 
        }

        return $data;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục là bắt buộc.',
            'name.string' => 'Tên danh mục phải là chuỗi.',
            'name.max' => 'Tên danh mục không được vượt quá 255 ký tự.',
            'name.unique' => 'Danh mục này đã tồn tại.',

            'avatar.required' => 'Ảnh danh mục là bắt buộc.',
            'avatar.image' => 'Tệp tải lên phải là một hình ảnh.',
            'avatar.mimes' => 'Ảnh danh mục chỉ được có định dạng jpg, jpeg, png.',
            'avatar.max' => 'Ảnh danh mục không được vượt quá 10MB.'
        ];
    }
}
