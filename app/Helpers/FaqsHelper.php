<?php
namespace App\Helpers;

use App\Models\Translation;
use Illuminate\Support\Str;

class FaqsHelper
{
    public static function data($request)
    {
        $locales = Translation::where('status',1)->get();
        $question = [];
        $answer = [];

        foreach ($locales as $locale) {
            $code = isset($locale['code']) ? $locale['code'] : 'az';
            $question[$code] = $request->input("question.".$code, '');
            $answer[$code] = $request->input("answer.".$code, '');
        }

        $data = [
            'question' => $question,
            'answer' => $answer
        ];
        return $data;
    }
}
