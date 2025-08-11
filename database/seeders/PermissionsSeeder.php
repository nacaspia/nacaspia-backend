<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'dashboards-view', 'guard_name' => 'admin', 'label' => 'dashboards'],

            ['name' => 'category-view', 'guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-create', 'guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-edit', 'guard_name' => 'admin', 'label' => 'category'],
            ['name' => 'category-delete', 'guard_name' => 'admin', 'label' => 'category'],

            ['name' => 'news-view', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-create', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-edit', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-delete', 'guard_name' => 'admin', 'label' => 'news'],

            ['name' => 'cms_users-view', 'guard_name' => 'admin', 'label' => 'cms_users'],
            ['name' => 'cms_users-create', 'guard_name' => 'admin', 'label' => 'cms_users'],
            ['name' => 'cms_users-edit', 'guard_name' => 'admin', 'label' => 'cms_users'],
            ['name' => 'cms_users-delete', 'guard_name' => 'admin', 'label' => 'cms_users'],

            ['name' => 'roles-view', 'guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-create', 'guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-edit', 'guard_name' => 'admin', 'label' => 'roles'],
            ['name' => 'roles-delete', 'guard_name' => 'admin', 'label' => 'roles'],

            ['name' => 'permissions-view', 'guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-create', 'guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-edit', 'guard_name' => 'admin', 'label' => 'permissions'],
            ['name' => 'permissions-delete', 'guard_name' => 'admin', 'label' => 'permissions'],

            ['name' => 'translations-view', 'guard_name' => 'admin', 'label' => 'translations'],
            ['name' => 'translations-create', 'guard_name' => 'admin', 'label' => 'translations'],
            ['name' => 'translations-edit', 'guard_name' => 'admin', 'label' => 'translations'],
            ['name' => 'translations-delete', 'guard_name' => 'admin', 'label' => 'translations'],

            ['name' => 'settings-view', 'guard_name' => 'admin', 'label' => 'settings'],

            ['name' => 'sliders-view', 'guard_name' => 'admin', 'label' => 'sliders'],
            ['name' => 'sliders-create', 'guard_name' => 'admin', 'label' => 'sliders'],
            ['name' => 'sliders-edit', 'guard_name' => 'admin', 'label' => 'sliders'],
            ['name' => 'sliders-delete', 'guard_name' => 'admin', 'label' => 'sliders'],

            ['name' => 'news-view', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-create', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-edit', 'guard_name' => 'admin', 'label' => 'news'],
            ['name' => 'news-delete', 'guard_name' => 'admin', 'label' => 'news'],

            ['name' => 'services-view', 'guard_name' => 'admin', 'label' => 'services'],
            ['name' => 'services-create', 'guard_name' => 'admin', 'label' => 'services'],
            ['name' => 'services-edit', 'guard_name' => 'admin', 'label' => 'services'],
            ['name' => 'services-delete', 'guard_name' => 'admin', 'label' => 'services'],

            ['name' => 'useful-link-view', 'guard_name' => 'admin', 'label' => 'useful-link'],
            ['name' => 'useful-link-create', 'guard_name' => 'admin', 'label' => 'useful-link'],
            ['name' => 'useful-link-edit', 'guard_name' => 'admin', 'label' => 'useful-link'],
            ['name' => 'useful-link-delete', 'guard_name' => 'admin', 'label' => 'useful-link'],

            ['name' => 'positions-view', 'guard_name' => 'admin', 'label' => 'positions'],
            ['name' => 'positions-create', 'guard_name' => 'admin', 'label' => 'positions'],
            ['name' => 'positions-edit', 'guard_name' => 'admin', 'label' => 'positions'],
            ['name' => 'positions-delete', 'guard_name' => 'admin', 'label' => 'positions'],

            ['name' => 'career-view', 'guard_name' => 'admin', 'label' => 'career'],
            ['name' => 'career-create', 'guard_name' => 'admin', 'label' => 'career'],
            ['name' => 'career-edit', 'guard_name' => 'admin', 'label' => 'career'],
            ['name' => 'career-delete', 'guard_name' => 'admin', 'label' => 'career'],
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->updateOrInsert(
                ['name' => $permission['name'], 'guard_name' => $permission['guard_name']],  // Şərt
                ['label' => $permission['label']]  // Yenilənəcək və ya əlavə olunacaq dəyərlər
            );
        }

    }
}
