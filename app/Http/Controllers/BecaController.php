<?php

namespace App\Http\Controllers;

use App\Models\Beca;
use Illuminate\Http\Request;
use Exception;

class BecaController extends Controller
{
    public function index() {
        return view('becas.index', ['becas' => Beca::all()]);
    }

    public function show($id) {
        return view('becas.mostrar', ['beca' => Beca::find($id)]);
    }

    public function create() {
        return view('becas.crear');
    }

    public function store(Request $req) {
        try {
            Beca::create($req->all());
            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Beca creada con exito!']);
        } catch (Exception $e) {
            $message = $e->getMessage();
            if(str_contains($message, 'nombre')) $message = 'Esta beca ya existe';

            return redirect()->back()->with('res', ['status' => 400, 'message' => $message, 'beca' => $req->except('_token')]);
        }
    }

    public function edit($id) {
        try {
            return view('becas.editar', ['beca' => Beca::findOrFail($id)]);
        } catch(Exception $e) {
            return redirect()->back()->with('res', ['status' => 400, 'message' => 'No se pudo encontrar esta beca']);
        }
    }

    public function update($id, Request $req) {
        try {
            Beca::find($id)->update($req->all());
            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Beca actualizada con exito!']);
        } catch(Exception $e) {
            $message = $e->getMessage();
            if(str_contains($message, 'nombre')) $message = 'Esta beca ya existe';

            $beca = $req->except('_token');
            $beca['id'] = $id;
            return redirect()->back()->with('res', ['status' => 400, 'message' => $message, 'beca' => $beca]);
        }
    }

    public function destroy($id) {
        try {
            Beca::find($id)->delete();
            return redirect()->route('beca.index')->with('res', ['status' => 200, 'message' => 'Beca eliminada con éxito']); 
        } catch(Exception $e) {
            return redirect()->back()->with('res', ['status' => 400, 'message' => 'No se pudo eliminar la beca']);
        }
    }
}
