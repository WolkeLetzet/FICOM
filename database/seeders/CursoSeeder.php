<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $curso = new Curso([
            'curso'=> 'Pre-Kinder',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Pre-Kinder',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Kinder',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Kinder',
            'paralelo' => 'B'
        ]);
        $curso->save();

        $curso = new Curso([
            'curso'=> 'Primero Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Primero Basico',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Segundo Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Tercero Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Cuarto Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Quinto Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Sexto Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Septimo Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Octavo Basico',
            'paralelo' => 'A'
        ]);
        $curso->save();


        $curso = new Curso([
            'curso'=> 'Primero Medio',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Segundo Medio',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> 'Tercero Medio',
            'paralelo' => 'A'
        ]);
        $curso->save();

    }
}
