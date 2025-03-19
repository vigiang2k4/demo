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
        return [
            'name' => 'required|string|unique:products,name',
            'category_id' => 'required|exists:categories,id',

            // Ảnh đại diện sản phẩm
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',

            // Bộ sưu tập ảnh sản phẩm
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',

            // Màu sắc
            'colors' => 'required|array|min:1',
            'colors.*' => 'exists:colors,id',

            // Kích thước
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,id',

            // Biến thể
            'variants' => 'required|array|min:1',
            'variants.*.color_id' => 'required|exists:colors,id',
            'variants.*.size_id' => 'required|exists:sizes,id',
            'variants.*.quantity' => 'required|integer|min:1',

            // Ảnh của từng biến thể
            'variants.*.avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được để trống.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',

            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ.',

            'avatar.image' => 'Tệp tải lên phải là hình ảnh.',
            'avatar.mimes' => 'Ảnh chỉ được phép có định dạng jpeg, png, jpg, gif, svg.',
            'avatar.max' => 'Ảnh không được vượt quá 10MB.',

            'gallery.*.image' => 'Ảnh bộ sưu tập phải là hình ảnh.',
            'gallery.*.mimes' => 'Ảnh bộ sưu tập chỉ chấp nhận jpeg, png, jpg, gif, svg.',
            'gallery.*.max' => 'Ảnh bộ sưu tập không được vượt quá 10MB.',

            'colors.required' => 'Phải chọn ít nhất một màu sắc.',
            'colors.*.exists' => 'Màu sắc không hợp lệ.',

            'sizes.required' => 'Phải chọn ít nhất một kích thước.',
            'sizes.*.exists' => 'Kích thước không hợp lệ.',

            'variants.required' => 'Phải có ít nhất một biến thể.',
            'variants.*.color_id.required' => 'Biến thể phải có màu sắc.',
            'variants.*.color_id.exists' => 'Màu sắc biến thể không hợp lệ.',
            'variants.*.size_id.required' => 'Biến thể phải có kích thước.',
            'variants.*.size_id.exists' => 'Kích thước biến thể không hợp lệ.',
            'variants.*.quantity.required' => 'Biến thể phải có số lượng.',
            'variants.*.quantity.integer' => 'Số lượng phải là số nguyên.',
            'variants.*.quantity.min' => 'Số lượng ít nhất là 1.',

            'variants.*.avatar.image' => 'Ảnh biến thể phải là hình ảnh.',
            'variants.*.avatar.mimes' => 'Ảnh biến thể chỉ chấp nhận jpeg, png, jpg, gif, svg.',
            'variants.*.avatar.max' => 'Ảnh biến thể không được vượt quá 10MB.',
        ];
    }

    /**
     * Xử lý dữ liệu trước khi đến controller.
     */
    public function validatedWithImage()
    {
        $data = $this->validated();

        // Nếu có ảnh đại diện sản phẩm, lưu vào storage
        if ($this->hasFile('avatar')) {
            $data['avatar'] = $this->file('avatar')->store('products', 'public');
        }

        // Nếu có bộ sưu tập ảnh, lưu vào storage
        if ($this->hasFile('gallery')) {
            $data['gallery'] = array_map(function ($image) {
                return $image->store('products/gallery', 'public');
            }, $this->file('gallery'));
        }

        // Nếu có ảnh đại diện biến thể, lưu vào storage
        foreach ($data['variants'] as $key => $variant) {
            if ($this->hasFile("variants.$key.avatar")) {
                $data['variants'][$key]['avatar'] = $this->file("variants.$key.avatar")
                    ->store('variants', 'public');
            }
        }

        return $data;
    }
}
