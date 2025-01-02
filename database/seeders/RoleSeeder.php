<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Root user: the superuser of the system.
        if (!Role::where('name', 'root')->first()) {
            Role::create([
                'name' => 'root'
            ]);
        }

        /**
         * Administrator user: possesses the second highest level of permissions in the system.
         * Possesses elevated privileges, second only to the root user.
         */
        if (!Role::where('name', 'administrator')->first()) {
            $administrator = Role::create([
                'name' => 'administrator'
            ]);

            $administrator->givePermissionTo([
                'index-course',
                'show-course',
                'create-course',
                'store-course',
                'edit-course',
                'update-course',
                'destroy-course',
            ]);
        }

        // Teacher user.
        if (!Role::where('name', 'teacher')->first()) {
            $teacher = Role::create([
                'name' => 'teacher'
            ]);

            $teacher->givePermissionTo([
                'index-course',
                'show-course',
                'create-course',
                'store-course',
                'edit-course',
                'update-course',
                'destroy-course',
            ]);
        }

        // Tutor user.
        if (!Role::where('name', 'tutor')->first()) {
            $tutor = Role::create([
                'name' => 'tutor'
            ]);

            $tutor->givePermissionTo([
                'index-course',
                'show-course',
                // 'create-course',
                // 'store-course',
                'edit-course',
                'update-course',
                // 'destroy-course',
            ]);
        }

        // Student user.
        if (!Role::where('name', 'student')->first()) {
            $student = Role::create([
                'name' => 'student'
            ]);

            $student->givePermissionTo([
                'index-course',
                'show-course',
                // 'create-course',
                // 'store-course',
                // 'edit-course',
                // 'update-course',
                // 'destroy-course',
            ]);
        }
    }
}
