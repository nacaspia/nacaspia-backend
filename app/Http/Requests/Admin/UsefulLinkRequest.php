<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class UsefulLinkRequest extends FormRequest
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
            'image' => $isCreate
            ?  'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:width=134,height=122|max:14'
            : 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:width=134,height=122|max:14',
            'title.az' => 'required|string|max:255',
            'link' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
            '*.string' => Lang::get('validation.string', ['attribute' => ':attribute']),
            'image.required' => 'Şəkil yükləmək məcburidir.',
            'image.image' => 'Yalnız şəkil faylları yüklənə bilər.',
            'image.mimes' => 'Şəkil yalnız jpeg, png, jpg, gif və ya svg formatında olmalıdır.',
            'image.dimensions' => 'Şəkilin ölçüsü 134x122 piksel olmalıdır.',
            'image.max' => 'Şəkil faylının maksimum ölçüsü 13.8 KB olmalıdır.'
        ];
    }
}
