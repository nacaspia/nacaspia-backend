<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class CommitsHelper
{
    public static function data($request)
    {
        $locales = Translation::where('status',1)->get();
        $name = [];
        $slug = [];
        $description = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $name[$code] = $request->input("name.".$code, '');
            $slug[$code] = Str::slug(trim($request->input("title.".$code, '')));
            $description[$code] = $request->input("description.".$code, '');
        }

        $data = [
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ];
        return $data;
    }
}
