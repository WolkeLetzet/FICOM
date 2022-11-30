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
                "tipoRegistro"=>"required",
                "file"=>"required"
            ]);

            if($request->tipoRegistro == "nomina"){

                $request->validate(["file"=> "mimes:xml"]);
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
                        return redirect()->back()->with("error","Error con el Registro");
                    }
                }
                return redirect()->back()->with('success','Registros subidos con Exito');
            }
            elseif($request->tipoRegistro == "prioritarios"){
                $request->validate(["file"=> "mimes:xlsx"]);
                $file = $request->file('file');
                $a = Storage::disk('local')->put('docs',$file);
                $process = new Process([
                    'python',
                    storage_path('app\xml\dataConverter2.py'),
                    storage_path('app/'.$a)
                ]);
                $process->run();

                // executes after the command finishes
                foreach ($process as $type => $data) {
                    if ($process::OUT === $type) {
                        dd($data);
                    } else { // $process::ERR === $type
                        return redirect()->back()->with("error","Error con el Registro");
                    }
                }
                return redirect()->back()->with('success','Registros subidos con Exito');

            }
            else{
                return redirect()->back()->with("error","Error con el Registro");
            }
            

            
            
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
}
