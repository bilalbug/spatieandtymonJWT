<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Database\Seeders\BlogCategorySeeder;
use Database\Seeders\BlogPostSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([UserSeeder::class, BlogCategorySeeder::class, BlogPostSeeder::class]);
        // Create roles
        $roles = [
            'super-admin',
            'admin',
            'editor',
            'contributor',
            'subscriber',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Define permissions
        $permissions = [
            'manage-users',
            'manage-roles',
            'manage-permissions',
            'manage-blog-posts',
            'publish-blog-posts',
            'manage-categories',
            'comment-on-blog-posts',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $superAdminRole = Role::findByName('super-admin');
        $superAdminRole->syncPermissions(Permission::all());

        $adminRole = Role::findByName('admin');
        $adminRole->syncPermissions([
            'manage-users',
            'manage-roles',
            'manage-permissions',
            'manage-blog-posts',
            'manage-categories',
        ]);

        $editorRole = Role::findByName('editor');
        $editorRole->syncPermissions([
            'manage-blog-posts',
            'publish-blog-posts',
            'manage-categories',
        ]);

        $contributorRole = Role::findByName('contributor');
        $contributorRole->syncPermissions([
            'manage-blog-posts',
        ]);

        $subscriberRole = Role::findByName('subscriber');
        $subscriberRole->syncPermissions([
            'comment-on-blog-posts',
        ]);
    }
}
