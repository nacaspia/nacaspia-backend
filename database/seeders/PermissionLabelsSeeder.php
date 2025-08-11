<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionLabelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $labels = [
            'dashboards',
            'category',
            'news',
            'cms_users',
            'roles',
            'permissions',
            'translations',
            'settings',
            'sliders',
            'news',
            'services',
            'useful-link',
            'positions',
            'career',
        ];

        foreach ($labels as $label) {
            DB::table('permission_labels')->updateOrInsert(
                ['label' => $label],   // Əgər bu "label" mövcud deyilsə
                ['label' => $label]    // Əlavə edir və ya yeniləyir
            );
        }

    }
}
