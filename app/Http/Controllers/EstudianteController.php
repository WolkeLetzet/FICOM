<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        return view('estudiante/listar');
    }

    public function perfil()
    {
        return view('estudiante/perfil');
    }

    public function showEditar()
    {
        return view('estudiante/editar');
    }

    public function pagos()
    {
        return view('estudiante/pagos');
    }

    public function update()
    {
        return view('estudiante/listar');
    }

    public function delete()
    {
        return view('estudiante/listar');
    }

    public function create()
    {
        return view('estudiante/listar');
    }
}
