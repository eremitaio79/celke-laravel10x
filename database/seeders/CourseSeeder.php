<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* Para inserir vários registros de uma vez, usar o 'insert' ao invés do 'create'.
            O método 'create' só insere um único registro por vez na tabela em questão. */
        Course::insert([
            [
                'name' => 'Química Aplicada',
                'description' => 'Teste de descrição 1',
                'image' => 'image 1...',
                'status' => 1,
            ],
            [
                'name' => 'Física Quântica',
                'description' => 'Teste de descrição 2',
                'image' => 'image 2...',
                'status' => 0,
            ],
            [
                'name' => 'Matemática Fundamental',
                'description' => 'Teste de descrição 3',
                'image' => 'image 3...',
                'status' => 1,
            ],
            [
                'name' => 'História Geral',
                'description' => 'Teste de descrição 4',
                'image' => 'image 4...',
                'status' => 0,
            ],
        ]);
    }
}
