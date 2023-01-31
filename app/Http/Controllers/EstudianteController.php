<?php

namespace App\Http\Controllers;

use App\Models\Apoderado;
use App\Models\ApoderadoEstudiante;
use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\Pago;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Freshwork\ChileanBundle\Exceptions\InvalidFormatException;
use Freshwork\ChileanBundle\Rut;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {   
        $perPage = request('perPage', 10); 
        $curso = request('curso', 'todos');

        //Busqueda y firtrado por Temas
        if ($curso != 'todos') {
            if($req->search){
                $estudiantes=Estudiante::with('curso')
                    ->searchByName($req->search)
                    ->searchBySurname($req->search)
                    ->searchByRut($req->search)
                    ->paginate($perPage);

                return view('estudiante.listar')
                ->with('estudiantes', $estudiantes)
                ->with('perPage', $perPage)
                ->with("cursos", Curso::all());
            }

            return view('estudiante.listar')
            ->with('estudiantes', Estudiante::with(['curso'])
                    ->where('curso_id', $curso)
                    ->paginate($perPage)
                )
            ->with('perPage', $perPage)
            ->with("cursos", Curso::all());
        }

        //Solo Busqueda
        if($req->search){
            return view('estudiante.listar')
            ->with('estudiantes', Estudiante::with(['curso'])
                    ->searchByName($req->search)
                    ->searchBySurname($req->search)
                    ->searchByRut($req->search)
                    ->paginate($perPage)
                )
            ->with('perPage', $perPage)
            ->with("cursos", Curso::all());
        }

        //Sin Busqueda ni Filtrado por Curso
        return view('estudiante.listar')
        ->with('estudiantes', Estudiante::with(['curso'])->paginate($perPage))    
        ->with('perPage', $perPage)
        ->with("cursos", Curso::all());
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
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                return redirect()->back()->with('res', ['status' => 200, 'message' => 'Registros subidos con éxito']);
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
                if (!$process->isSuccessful()) {
                    throw new ProcessFailedException($process);
                }
                return redirect()->back()->with('res', ['status' => 200, 'message' => 'Registros subidos con éxito']);
            }
            else{
                return redirect()->back()->with('res', ['status' => 400, 'message' => 'Error al subir el registro']);
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
        $estudiante = Estudiante::find($id);
        $estudiante->curso = $estudiante->curso;
        $estudiante->apoderado_titular = $estudiante->apoderadoTitular()->first();
        $estudiante->apoderado_suplente = $estudiante->apoderadoSuplente()->first();

        return view('estudiante.perfil')->with('estudiante', $estudiante)->with('cursos', Curso::all());
    }
    
    public function pagos($id)
    {
        $estudiante = Estudiante::find($id);
        $estudiante['pagos'] = $estudiante->pagosPorAnio('2023')->get();
        return view('estudiante.pagos')->with(['estudiante' => $estudiante]);
    }

    public function getEstudiantesNuevos(Request $req) {
        $perPage = request('perpage', '10');
        $estudiantes = Estudiante::with('curso')->where('es_nuevo', '1')->latest()->paginate($perPage);
        
        return view('estudiante.listar')->with(['estudiantes' => $estudiantes, 'cursos' => Curso::all(), 'perPage' => $perPage]);
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
            Rut::parse($req->run)->validate();
            $rut = Rut::parse($req->run)->format(Rut::FORMAT_ESCAPED);
            $rut = Rut::parse($rut)->toArray();

            
            //Estudiante
            $estudiante = new Estudiante();
            $estudiante->nombres = $req->nombres;
            $estudiante->apellidos = $req->apellido_paterno . ' ' . $req->apellido_materno;
            $estudiante->rut = $rut[0];
            $estudiante->dv = $rut[1];
            $estudiante->es_nuevo = 1;
            $estudiante->direccion = $req->direccion;
            $estudiante->telefono = $req->telefono;
            $estudiante->curso_id = $req->nivel;
            $estudiante->prioridad = $req->prioridad;
            $estudiante->save();
            
            //Apoderado
            if($req->apellidos != '' || $req->names != '' || $req->telefono != '' || $req->email != '' || $req->direccion != '') {
               $apoderado = new Apoderado();
               $apoderado->apellidos = $req->apellidos;
               $apoderado->nombres = $req->names;
               $apoderado->telefono = $req->telefono;
               $apoderado->email = $req->email;
               $apoderado->direccion = $req->direccion;
               
               $estudiante->apoderados()->save($apoderado);
            }

            //Apoderado suplente
            if($req->sub_apellidos != '' || $req->sub_names != '' || $req->sub_telefono != '' || $req->sub_email != '' || $req->sub_direccion != '') {
                $apoderado_sub = new Apoderado();
                $apoderado_sub->apellidos = $req->sub_apellidos;
                $apoderado_sub->nombres = $req->sub_names;
                $apoderado_sub->telefono = $req->sub_telefono;
                $apoderado_sub->email = $req->sub_email;
                $apoderado_sub->direccion = $req->sub_direccion;
                $estudiante->apoderados()->save($apoderado_sub, ['es_suplente' => true]);
            }

            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Estudiante creado con exito!']);
        }
        catch(InvalidFormatException $e){
            $message = "RUT Incorrecto";
            return redirect()->back()->with('res', ['status' => 400, 'message' => $message, 'estudiante' => $req->except('_token')]);
        }
        catch (Exception $e) {
            $message = 'Ha ocurrido un error';
            if(str_contains($e->getMessage(), 'apoderado')) $message = $e->getMessage() ;
            if(str_contains($e->getMessage(), 'estudiantes_rut_unique')) $message = 'Este estudiante ya se encuentra registrado';

            return redirect()->back()->with('res', ['status' => 400, 'message' => $message, 'estudiante' => $req->except('_token')]);
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
    public function update($id, Request $request)
    {
        try {

            $estudiante = Estudiante::find($id);
            Rut::parse($request->run)->validate();
            $rut = Rut::parse($request->run)->format(Rut::FORMAT_ESCAPED);
            $rut = Rut::parse($rut)->toArray();
            $estudiante->apellidos = $request->apellidos;
            $estudiante->nombres = $request->nombres;
            $estudiante->rut = $rut[0];
            $estudiante->dv = $rut[1];
            $estudiante->email_institucional = $request->email_institucional;
            $estudiante->prioridad = $request->prioridad;
            $estudiante->curso_id = $request->nivel;
            $estudiante->telefono = $request->telefono;
            $estudiante->direccion = $request->direccion;
            
            if(count($estudiante->apoderadoTitular()->get()) == 0) {
                $apoderado = new Apoderado();
                $apoderado->apellidos = $request->lastnames;
                $apoderado->nombres = $request->names;
                $apoderado->telefono = $request->telefono;
                $apoderado->email = $request->email;
                $apoderado->direccion = $request->direccion;
                $estudiante->apoderados()->save($apoderado);
            } else {
                $estudiante->apoderadoTitular()->update([
                   'apellidos' => $request->lastnames,
                   'nombres' => $request->names,
                   'telefono' => $request->telefono,
                   'email' => $request->email,
                   'direccion' => $request->direccion, 
                ]);
            }
    
            if(count($estudiante->apoderadoSuplente()->get()) == 0) {
                $apoderado = new Apoderado();
                $apoderado->apellidos = $request->sub_lastnames;
                $apoderado->nombres = $request->sub_names;
                $apoderado->telefono = $request->sub_telefono;
                $apoderado->email = $request->sub_email;
                $apoderado->direccion = $request->sub_direccion;
                $estudiante->apoderados()->save($apoderado, ['es_suplente' => true]);
            } else {
                $estudiante->apoderadoSuplente()->update([
                   'apellidos' => $request->sub_lastnames,
                   'nombres' => $request->sub_names,
                   'telefono' => $request->sub_telefono,
                   'email' => $request->sub_email,
                   'direccion' => $request->sub_direccion, 
                ]);
            }
    
            $estudiante->save();
            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Estudiante actualizado con exito!']);
        } catch (Exception $e) {
            return redirect()->back()->with('res', ['status' => 400, 'message' => 'Error al actualizar el estudiante']);
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


    /* Pagos ------------------------------------------- */
    public function registrarPago($id, Request $request) {
        try {
            $array = $request->all();
            $array['anio'] = date("y");
            $array['estudiante_id'] = $id;
            $pago = New Pago($array);
            $pago->save();

            return redirect()->back()->with('res', ['status' => 200, 'message' => 'Pago registrado con éxito']);
        } catch (Exception $e) {
            return redirect()->back()->with('res', ['status' => 400, 'message' => 'Ha ocurrido un error', 'datos' => $request->except('_token')]);
        }
    }
}
