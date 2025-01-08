<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'index-course',
            'show-course',
            'create-course',
            'store-course',
            'edit-course',
            'update-course',
            'destroy-course',

            'index-role',
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission)->first();

            if (!$existingPermission) {
                Permission::create([
                    'name' => $permission,
                    'guard_name' => 'web'
                ]);
            }
        }
    }
}
