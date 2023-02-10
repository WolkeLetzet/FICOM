<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Exception;

class CursoController extends Controller
{
    public function index() {
        $cursos = Curso::all();
        return view('curso.index', ['cursos' => $cursos]);
    }

    public function show($id) {
        return view('curso.mostrar', ['curso' => Curso::with('estudiantes')->find($id)]);
    }

    public function create() {

    }

    public function store() {

    }

    public function edit($id) {
        return view('curso.editar', ['curso' => Curso::with('estudiantes')->find($id)]);
    }

    public function update($id, Request $req) {
        try {
            Curso::find($id)->update($req->all());
            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Curso actualizado con éxito']); 
        } catch(Exception $e) {
            dd($e);
            $curso = $req->except('_token');
            return redirect()->back()->with('res', ['status' => 400, 'message' => 'No se pudo actualizar el curso', 'cursoErr' => $curso]);
        }
    }

    public function destroy($id) {
        try {
            Curso::find($id)->delete();
            return redirect()->route('beca.index')->with('res', ['status' => 200, 'message' => 'Curso eliminado con éxito']); 
        } catch(Exception $e) {
            return redirect()->back()->with('res', ['status' => 400, 'message' => 'No se pudo eliminar el curso']);
        }
    }
}
