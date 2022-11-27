<?php

namespace App\Http\Controllers;

use App\Models\Apoderado;
use App\Models\Curso;
use App\Models\Estudiante;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estudiante.listar')->with('estudiantes',Estudiante::with(['curso','apoderado'])->get())
        ->with('apoderados',Apoderado::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        try {
            $estudiante = new Estudiante();
            $estudiante->nombres = $req->nombres;
            $estudiante->apellidos = $req->apellidos;
            $estudiante->rut = $req->run;
            $estudiante->prioridad = $req->prioridad;
            $estudiante->save();
    
            return response('Estudiante creado con exito');
        } catch (Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Store massively resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMassive(Request $request)
    {
        try {
            $process = new Process(['python',storage_path('app\xml\dataConverter.py')]);
            $process->run();

            // executes after the command finishes
            foreach ($process as $type => $data) {
                if ($process::OUT === $type) {
                    dd($data);
                } else { // $process::ERR === $type
                    dd($data);
                }
            }
            
            $file = $request->file('file');
            $a = Storage::disk('local')->put('docs',$file);
            
            dd($file,$process->getOutput(),storage_path('app\xml\dataConverter.py'));
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $estudiante = Estudiante::where('id', $id)->with(['curso','apoderado'])->get();
        return view('estudiante.perfil')->with('estudiante', $estudiante[0]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('estudiante.editar',[]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Estudiante  $estudiante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pagos($id)
    {
        return view('estudiante.pagos');
    }
}
