<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Afdhal',
            'email' => 'afdhalrashid90@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $admin = User::create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $staf = User::create([
            'name' => 'Staf 1',
            'email' => 'staf1@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $owner = User::create([
            'name' => 'Owner 1',
            'email' => 'owner1@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $tenant = User::create([
            'name' => 'Tenant 1',
            'email' => 'tenant1@gmail.com',
            'password' => bcrypt('12345678'),
            'created_by' => 1,
            'status' => 1
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Staf']);
        $role3 = Role::create(['name' => 'Owner']);
        $role4 = Role::create(['name' => 'Tenant']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
        $admin->assignRole([$role1->id]);
        $staf->assignRole([$role2->id]);
        $owner->assignRole([$role3->id]);
        $tenant->assignRole([$role4->id]);
    }
}
