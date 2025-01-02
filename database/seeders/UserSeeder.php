<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Superuser.
        if (!User::where('email', 'root@system.com')->first()) {
            $root = User::create([
                'name' => 'root',
                'email' => 'root@system.com',
                'password' => Hash::make('123456', ['rounds' => 10]),
            ]);

            $root->assignRole('root');
        }

        // Highest user.
        if (!User::where('email', 'pauloeremita@gmail.com')->first()) {
            $administrator = User::create([
                'name' => 'Paulo Eremita',
                'email' => 'pauloeremita@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 10]),
            ]);

            $administrator->assignRole('administrator');
        }

        // Teacher user.
        if (!User::where('email', 'jober@gmail.com')->first()) {
            $teacher = User::create([
                'name' => 'Jobervaldo Pereira',
                'email' => 'jober@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 10]),
            ]);

            $teacher->assignRole('teacher');
        }

        // Tutor user.
        if (!User::where('email', 'johntheknow@gmail.com')->first()) {
            $tutor = User::create([
                'name' => 'John The Know',
                'email' => 'johntheknow@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 10]),
            ]);

            $tutor->assignRole('tutor');
        }

        // Student user.
        if (!User::where('email', 'jocamoca@gmail.com')->first()) {
            $student = User::create([
                'name' => 'Joca Moca',
                'email' => 'jocamoca@gmail.com',
                'password' => Hash::make('123456', ['rounds' => 10]),
            ]);

            $student->assignRole('student');
        }
    }
}
