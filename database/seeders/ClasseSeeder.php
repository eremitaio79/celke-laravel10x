<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classe::insert([
            [
                'name' => 'Cálculo estequiométrico',
                'description' => 'Descrição aula 1',
                'status' => 1,
                'image' => 'image 1...',
                'course_id' => '1',
            ],
            [
                'name' => 'Cinemática',
                'description' => 'Cinemática geral',
                'status' => 1,
                'image' => 'image 2...',
                'course_id' => '2',
            ],
            [
                'name' => 'Hidrostática',
                'description' => 'Descrição da aula de hidrostática',
                'status' => 1,
                'image' => 'image 3...',
                'course_id' => '2',
            ],
            [
                'name' => 'Trigonometria',
                'description' => 'Apresentação da disciplina',
                'status' => 1,
                'image' => 'image 4...',
                'course_id' => '3',
            ],
            [
                'name' => 'Revolução francesa',
                'description' => 'O que levou à revolução francesa?',
                'status' => 0,
                'image' => 'image 5...',
                'course_id' => '4',
            ],
        ]);
    }
}
