<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class NewsRequest extends FormRequest
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

    public function rules()
    {
        $isCreate = $this->isMethod('post');
        return [
           'image' => $isCreate ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'image|mimes:jpeg,png,jpg,gif,svg',
           'slider_image.*' => $isCreate ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg' : 'image|mimes:jpeg,png,jpg,gif,svg',
            'category_id' => 'required|integer|max:255',
            'title.az' => 'required|string|max:255',
            'text.az' => 'nullable|string',
            'fulltext.az' => 'nullable|string',
//            'datetime' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
            '*.string' => Lang::get('validation.string', ['attribute' => ':attribute']),
//            'datetime.date' => Lang::get('validation.date', ['attribute' => ':attribute']),
            'image.required' => 'Şəkil yükləmək məcburidir.',
            'image.image' => 'Yalnız şəkil faylları yüklənə bilər.',
            'image.mimes' => 'Şəkil yalnız jpeg, png, jpg, gif və ya svg formatında olmalıdır.',
            'image.dimensions' => 'Şəkilin ölçüsü 1228x1228 piksel olmalıdır.',
            'image.max' => 'Şəkil faylının maksimum ölçüsü 226 KB olmalıdır.',
            'slider_image.*.required' => 'Hər bir slayd şəkili yüklənməlidir.',
            'slider_image.*.image' => 'Yalnız şəkil faylları yüklənə bilər.',
            'slider_image.*.mimes' => 'Şəkil yalnız jpeg, png, jpg, gif və ya svg formatında olmalıdır.',
            'slider_image.*.dimensions' => 'Hər bir şəkilin ölçüsü 1228x1228 piksel olmalıdır.',
            'slider_image.*.max' => 'Hər bir şəkil faylının maksimum ölçüsü 237 KB olmalıdır.'
        ];
    }
}
