<?php
namespace App\Helpers;
use App\Models\Translation;

class AboutHelper
{
    public static function data($request,$about,$instituteCategoryId)
    {
        $locales = Translation::where('status',1)->get();
        $title = []; $text = []; $fulltext = [];
        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $title[$code] = $request->input("title.".$code, '');
            $text[$code] = $request->input("text.".$code, '');
            $fulltext[$code] = $request->input("fulltext.".$code, '');
        }

        $slider_images = [];
        if (!empty($about->slider_image)) {
            // Əgər $about->slider_image array tipindədirsə, birbaşa istifadə et, yoxsa JSON decode et
            $slider_images = is_array($about->slider_image)
                ? $about->slider_image
                : json_decode($about->slider_image, true);
        }

        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $slider_image) {
                if ($slider_image->isValid()) {
                    // Yeni şəkili yaddaşa yaz
                    $filename = time() . '-' . $slider_image->getClientOriginalName();
                    $slider_image->move(public_path('uploads/institute/abouts'), $filename);
                    $slider_images[] = $filename; // Yeni şəkili siyahıya əlavə et
                }
            }
        }

// Yadda saxlanacaq məlumat
        $data = [
            'category_id' => $instituteCategoryId,
            'slider_image' => $slider_images, // Şəkilləri JSON formatında saxla
            'title' => $title,
            'text' => $text,
            'fulltext' => $fulltext
        ];


        return $data;
    }
}
