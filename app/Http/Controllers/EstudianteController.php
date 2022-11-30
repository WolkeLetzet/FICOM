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
        return view('estudiante.listar')->with('estudiantes', Estudiante::with(['curso','apoderado'])->get())
        ->with('apoderados', Apoderado::all());
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
           
            $request->validate([
                "file.*"=> "mimes:xml",
                "file"=>"required"
            ]);
            
            $file = $request->file('file');
            $a = Storage::disk('local')->put('docs',$file);
            $process = new Process([
                'python',
                storage_path('app\xml\dataConverter.py'),
                storage_path('app/'.$a)
            ]);
            $process->run();

            // executes after the command finishes
            foreach ($process as $type => $data) {
                if ($process::OUT === $type) {
                    dd($data);
                } else { // $process::ERR === $type
                    dd($data);
                }
            }
            
            return redirect()->back();
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
        return view('estudiante.perfil')->with(['estudiante' => $estudiante[0], 'cursos' => Curso::all()]);
    }
    
    public function pagos($id)
    {
        return view('estudiante.pagos');
    }

    public function getEstudiantesNuevos() {
        return view('estudiante.listar')->with('estudiantes', Estudiante::with(['curso','apoderado'])->where('es_nuevo', '1')->get())
        ->with('apoderados', Apoderado::all());
    }

    public function showCrear() {
        return view('estudiante/crear')->with('cursos', Curso::all());
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        try {
            if($req->apellidos || $req->names || $req->telefono || $req->email || $req->direccion) {
               $apoderado = new Apoderado();
               $apoderado->apellidos = $req->apellidos;
               $apoderado->nombres = $req->names;
               $apoderado->telefono = $req->telefono;
               $apoderado->email = $req->email;
               $apoderado->direccion = $req->direccion;
               $apoderado->save();
            }

            $estudiante = new Estudiante();
            $estudiante->nombres = $req->nombres;
            $estudiante->apellidos = $req->apellido_paterno . ' ' . $req->apellido_materno;
            $estudiante->rut = $req->run;
            $estudiante->es_nuevo = 1;
            $estudiante->curso_id = $req->nivel;
            
            $estudiante->prioridad = $req->prioridad;
            if($apoderado) $estudiante->apoderado()->associate($apoderado);
            $estudiante->save();
            

            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Estudiante creado con exito!']);
        } catch (Exception $e) {
            $message = 'Ha ocurrido un error';
            if(str_contains($e->getMessage(), 'apoderado')) $message = 'Completa todos los datos del apoderado!';
            
            if(str_contains($e->getMessage(), 'estudiantes_rut_unique')) $message = 'Este estudiante ya se encuentra registrado';
            $es = [
                'nombres' => $req->nombres,
                'apellido_paterno' => $req->apellido_paterno,
                'apellido_materno' => $req->apellido_materno,
                'run' => $req->run,
                'nivel' => $req->nivel,
                'prioridad' => $req->prioridad,
                'names' => $req->names,
                'apellidos' => $req->apellidos,
                'telefono' => $req->telefono,
                'email' => $req->email,
                'direccion' => $req->direccion
            ];

            return redirect()->back()->with('res', ['status' => 400, 'message' => $message, 'estudiante' => $es]);
        }
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
    public function update(Request $req)
    {
        try {
            $estudiante = Estudiante::where('id', $req->id)->first();
            $estudiante->apellidos = $req->apellidos;
            $estudiante->nombres = $req->nombres;
            $estudiante->rut = $req->run;
            $estudiante->prioridad = $req->prioridad;
            $estudiante->email_institucional = $req->email_institucional;
            $estudiante->curso_id = $req->nivel;
            
            //Si no tenia un apoderado, se crea uno y se le asocia
            if($req->names || $req->lastnames || $req->telefono || $req->email || $req->direccion) {
                if($req->apoderado) $apoderado = Apoderado::where('id', $req->apoderado)->first();
                else $apoderado = new Apoderado();
                $apoderado->nombres = $req->names;
                $apoderado->apellidos = $req->lastnames;
                $apoderado->email = $req->email;
                $apoderado->telefono = $req->telefono;
                $apoderado->direccion = $req->direccion;
                
                $apoderado->save();
    
                if(!$req->apoderado) $estudiante->apoderado()->associate($apoderado);
            }
            $estudiante->save();
            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Estudiante actualizado con exito!']);;
        } catch (Exception $e) {
            $message = 'Ha ocurrido un error';
            if(str_contains($e->getMessage(), 'apoderado')) $message = 'Completa todos los datos del apoderado!';
            if(str_contains($e->getMessage(), 'estudiantes_rut_unique')) $message = 'Este estudiante ya se encuentra registrado';
            return redirect()->back()->with('res', ['status' => 400, 'message' => $message]);
        }
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
}
