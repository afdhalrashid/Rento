<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        $permissions = [
            'admin-list',
            'admin-create',
            'admin-edit',
            'admin-delete',
            'staf-list',
            'staf-create',
            'staf-edit',
            'staf-delete',
            'owner-list',
            'owner-create',
            'owner-edit',
            'owner-delete',
            'tenant-list',
            'tenant-create',
            'tenant-edit',
            'tenant-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'house-list',
            'house-create',
            'house-edit',
            'house-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
