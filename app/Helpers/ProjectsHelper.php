<?php

namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProjectsHelper
{
    public static function data($request,$project = null)
    {

        $locales = Translation::where('status',1)->get();
        $name = []; $description = []; $slug = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $name[$code] = $request->input("name.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("name.".$code, '')));
            $description[$code] = $request->input("description.".$code, '');
        }

        if($request->hasFile('image')){
            $image = time().$request->image->extension();
            $request->image->move(public_path('uploads/projects'), $image);
        }else{
            $image = !empty($news->image)? $news->image: NULL;
        }

        $slider_images = [];
        if (!empty($project->slider_image)) {
            // Əgər $about->slider_image array tipindədirsə, birbaşa istifadə et, yoxsa JSON decode et
            $slider_images = is_array($project->slider_image)
                ? $project->slider_image
                : json_decode($project->slider_image, true);
        }

        if ($request->hasFile('slider_image')) {
            foreach ($request->file('slider_image') as $slider_image) {
                if ($slider_image->isValid()) {
                    // Yeni şəkili yaddaşa yaz
                    $filename = time() . '-' . $slider_image->getClientOriginalName();
                    $slider_image->move(public_path('uploads/projects/slider_image'), $filename);
                    $slider_images[] = $filename; // Yeni şəkili siyahıya əlavə et
                }
            }
        }

        $data = [
            'category_id' => $request->category_id,
            'image' => $image,
            'slider_image' => $slider_images,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'status' => $request->status,
            'is_main' => $request->is_main,
        ];

        return $data;
    }
}
