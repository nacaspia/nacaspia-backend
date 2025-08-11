<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;

class ServiceRequest extends FormRequest
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
            'image' => $isCreate ? 'image|mimes:jpeg,png,jpg,gif,svg': 'image|mimes:jpeg,png,jpg,gif,svg',
            'files.*' => $isCreate ? 'file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xlsx,xls,txt': 'file|mimes:jpeg,png,jpg,gif,svg,pdf,doc,docx,xlsx,xls,txt',
            'title.az' => 'required|string|max:255',
            'text.az' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => Lang::get('validation.required', ['attribute' => ':attribute']),
            '*.string' => Lang::get('validation.string', ['attribute' => ':attribute']),
            'image.image' => 'Yalnız şəkil faylları yüklənə bilər.',
            'image.mimes' => 'Şəkil yalnız jpeg, png, jpg, gif və ya svg formatında olmalıdır.',
            /*'image.dimensions' => 'Şəkilin ölçüsü 1000x646 piksel olmalıdır.',
            'image.max' => 'Şəkil faylının maksimum ölçüsü 101 KB olmalıdır.'*/
        ];
    }
}
