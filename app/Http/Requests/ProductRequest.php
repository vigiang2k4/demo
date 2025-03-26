<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $isUpdating = $this->isMethod('PUT') || $this->isMethod('PATCH');

        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',

            // Avatar chỉ bắt buộc khi tạo mới
            'avatar' => $isUpdating ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240' : 'required|image|mimes:jpeg,png,jpg,gif|max:10240',

            'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',

            'variants' => 'nullable|array',
            'variants.*.color_id' => 'required_with:variants|exists:colors,id',
            'variants.*.size_id' => 'required_with:variants|exists:sizes,id',
            'variants.*.quantity' => 'required_with:variants|integer|min:1',
            'variants.*.price' => 'required_with:variants|numeric|min:0',

            // Ảnh biến thể chỉ bắt buộc khi tạo mới
            'variants.*.avatar' => $isUpdating ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240' : 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',

            'avatar.required' => 'Ảnh đại diện là bắt buộc khi tạo mới.',
            'avatar.image' => 'Tệp tải lên phải là hình ảnh.',
            'avatar.mimes' => 'Ảnh chỉ được phép có định dạng jpeg, png, jpg, gif.',
            'avatar.max' => 'Ảnh không được vượt quá 10MB.',

            'image.*.image' => 'Ảnh bộ sưu tập phải là hình ảnh.',
            'image.*.mimes' => 'Ảnh bộ sưu tập chỉ chấp nhận jpeg, png, jpg, gif.',
            'image.*.max' => 'Ảnh bộ sưu tập không được vượt quá 10MB.',

            'variants.required' => 'Phải có ít nhất một biến thể.',
            'variants.*.color_id.required' => 'Biến thể phải có màu sắc.',
            'variants.*.color_id.exists' => 'Màu sắc biến thể không hợp lệ.',
            'variants.*.size_id.required' => 'Biến thể phải có kích thước.',
            'variants.*.size_id.exists' => 'Kích thước biến thể không hợp lệ.',
            'variants.*.quantity.required' => 'Biến thể phải có số lượng.',
            'variants.*.quantity.integer' => 'Số lượng phải là số nguyên.',
            'variants.*.quantity.min' => 'Số lượng ít nhất là 1.',

            'variants.*.price.required' => 'Biến thể phải có giá.',
            'variants.*.price.numeric' => 'Giá phải là một số.',
            'variants.*.price.min' => 'Giá ít nhất phải là 0.',

            'variants.*.avatar.image' => 'Ảnh biến thể phải là hình ảnh.',
            'variants.*.avatar.mimes' => 'Ảnh biến thể chỉ chấp nhận jpeg, png, jpg, gif.',
            'variants.*.avatar.max' => 'Ảnh biến thể không được vượt quá 10MB.',
        ];
    }

    public function getValidated()
    {
        $data = parent::validated();

        // Xử lý ảnh đại diện sản phẩm
        if ($this->hasFile('avatar')) {
            $data['avatar'] = $this->file('avatar')->store('products', 'public');
        }

        // Xử lý ảnh bộ sưu tập
        if ($this->hasFile('image')) {
            $data['image'] = array_map(fn($file) => $file->store('product_images', 'public'), $this->file('image'));
        }

        // Xử lý ảnh biến thể sản phẩm
        if (!empty($data['variants'])) {
            foreach ($data['variants'] as &$variant) {
                // Chỉ lưu ảnh nếu có file tải lên
                if (isset($variant['avatar']) && is_file($variant['avatar'])) {
                    $variant['avatar'] = $variant['avatar']->store('variants', 'public');
                } else {
                    unset($variant['avatar']); // Tránh lỗi khi không có ảnh mới
                }
            }
        }

        return $data;
    }
}
