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
            'curso'=> '1°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '1°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '2°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '2°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '3°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '3°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '4°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '4°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '5°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '5°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '6°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '6°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '7°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '7°',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '8°',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '8°',
            'paralelo' => 'B'
        ]);
        $curso->save();


        $curso = new Curso([
            'curso'=> '1°M',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '1°M',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '2°M',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '2°M',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '3°M',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '3°M',
            'paralelo' => 'B'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '4°M',
            'paralelo' => 'A'
        ]);
        $curso->save();
        $curso = new Curso([
            'curso'=> '4°M',
            'paralelo' => 'B'
        ]);
        $curso->save();

    }
}
