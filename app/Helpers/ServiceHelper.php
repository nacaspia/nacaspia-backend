<?php

namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class ServiceHelper
{
    public static function data($request,$service = null)
    {

        $locales = Translation::where('status',1)->get();
        $title = []; $text = []; $slug = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $title[$code] = $request->input("title.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("title.".$code, '')));
            $text[$code] = $request->input("text.".$code, '');
        }

        if($request->hasFile('image')){
            $image = time().$request->image->extension();
            $request->image->move(public_path('uploads/services'), $image);
        }else{
            $image = !empty($service->image)? $service->image: NULL;
        }

        $slider_files = [];
        if (!empty($service->files)) {
            // Əgər $about->slider_image array tipindədirsə, birbaşa istifadə et, yoxsa JSON decode et
            $slider_files = is_array($service->files)
                ? $service->files
                : json_decode($service->files, true);
        }

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $slider_file) {
                if ($slider_file->isValid()) {
                    // Yeni şəkili yaddaşa yaz
                    $filename = $slider_file->getClientOriginalName();
                    $slider_file->move(public_path('uploads/service/files'), $filename);
                    $slider_files[] = $filename; // Yeni şəkili siyahıya əlavə et
                }
            }
        }


        $data = [
            'parent_id' => !empty($request->parent_id)? $request->parent_id: null,
            'sub_parent_id' => !empty($request->sub_parent_id)? $request->sub_parent_id: null,
            'image' => $image ?? 0,
            'files' =>  $slider_files,
            'title' => $title,
            'slug' => $slug,
            'text' => $text,
            'is_service_type' => $request->is_service_type,
            'is_calculator' => $request->is_calculator,
            'status' => $request->status
        ];
        return $data;
    }
}
