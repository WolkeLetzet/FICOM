@extends('layouts.app')
@section('content')

<div class="container">
    <form method="POST" action="{{route('updateEstudiante', $estudiante->id)}}" class="mt-3 row">
        @csrf
        <h2>Estudiante</h2>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos"  class="form-control" value="{{$estudiante->apellidos}}" disabled>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" id="nombres" class="form-control" value="{{$estudiante->nombres}}" disabled>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="run" class="form-label">RUN</label>
            <input type="text" name="run" id="run" class="form-control" value="{{$estudiante->rut . '-' . $estudiante->dv}}" disabled>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="email_institucional" class="form-label">Correo Institucional</label>
            <input type="email" name="email_institucional" id="email_institucional" class="form-control" value="{{$estudiante->email_institucional}}" disabled>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="nivel" class="form-label">Nivel</label>
            <select id="nivel" name="nivel" id="nivel" class="form-control form-select" disabled>
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" @if($estudiante->curso_id == $curso->id) selected @endif>{{$curso->curso . '-' . $curso->paralelo}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select name="prioridad" id="prioridad" class="form-control form-select" disabled>
                <option value="Alumno regular" @if($estudiante->prioridad == "Alumno regular") selected @endif>No proritario</option>
                <option value="Nuevo Prioritario" @if($estudiante->prioridad == "Nuevo Prioritario") selected @endif>Nuevo proritario</option>
                <option value="Prioritario" @if($estudiante->prioridad == "Prioritario") selected @endif>Proritario</option>
            </select>
        </div>
        <h2 class="mt-3">Apoderado</h2> 
        <div class="form-group mb-3 col-6">
            <label for="names" class="form-label">Nombres</label>
            <input type="text" id="names" name="names" class="form-control" 
                value="{{$estudiante->apoderado_titular ? $estudiante->apoderado_titular->nombres : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="lastnames" class="form-label">Apellidos</label>
            <input type="text" id="lastnames" name="lastnames" class="form-control" 
                value="{{$estudiante->apoderado_titular ? $estudiante->apoderado_titular->apellidos : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" id="telefono" name="telefono" class="form-control" 
                value="{{$estudiante->apoderado_titular ? $estudiante->apoderado_titular->telefono : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" 
                value="{{$estudiante->apoderado_titular ? $estudiante->apoderado_titular->email : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" id="direccion" name="direccion" class="form-control" 
                value="{{$estudiante->apoderado_titular ? $estudiante->apoderado_titular->direccion : ''}}" disabled
            >
        </div>

        <h2 class="mt-3">Apoderado suplente</h2>
        <div class="form-group mb-3 col-6">
            <label for="sub_names" class="form-label">Nombres</label>
            <input type="text" id="sub_names" name="sub_names" class="form-control" 
                value="{{$estudiante->apoderado_suplente ? $estudiante->apoderado_suplente->nombres : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="sub_lastnames" class="form-label">Apellidos</label>
            <input type="text" id="sub_lastnames" name="sub_lastnames" class="form-control" 
                value="{{$estudiante->apoderado_suplente ? $estudiante->apoderado_suplente->apellidos : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="sub_telefono" class="form-label">Teléfono</label>
            <input type="text" id="sub_telefono" name="sub_telefono" class="form-control" 
                value="{{$estudiante->apoderado_suplente ? $estudiante->apoderado_suplente->telefono : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="sub_email" class="form-label">Correo Electrónico</label>
            <input type="email" id="sub_email" name="sub_email" class="form-control" 
                value="{{$estudiante->apoderado_suplente ? $estudiante->apoderado_suplente->email : ''}}" disabled
            >
        </div>
        <div class="form-group mb-3 col-6">
            <label for="sub_direccion" class="form-label">Dirección</label>
            <input type="text" id="sub_direccion" name="sub_direccion" class="form-control" 
                value="{{$estudiante->apoderado_suplente ? $estudiante->apoderado_suplente->direccion : ''}}" disabled
            >
        </div>
        
        <div class="buttons">
            <button type="button" id="btn-editar" class="btn btn-secondary" onclick="editar()">Editar</button>
            <button type="button" id="btn-cancelar" class="btn btn-danger" onclick="cancelEditar()" hidden>Cancelar</button>
            <button type="submit" id="btn-enviar" class="btn btn-primary" hidden>Guardar</button>
        </div>
    </form>

    <div class="buttons mt-3">
        <a href="{{ route('pagosEstudiante', $estudiante->id) }}" class="btn btn-primary">Ver historial de pago</a>
    </div>
</div>
<script>
    const btneditar = document.getElementById('btn-editar');
    const cancelar = document.getElementById('btn-cancelar');
    const enviar = document.getElementById('btn-enviar');

    //Estudiante
    const apellidos = document.getElementById('apellidos');
    const nombres = document.getElementById('nombres');
    const run = document.getElementById('run');
    const email_institucional = document.getElementById('email_institucional');
    const nivel = document.getElementById('nivel');
    const prioridad = document.getElementById('prioridad');
    
    //Apoderado
    const names = document.getElementById('names');
    const lastnames = document.getElementById('lastnames');
    const telefono = document.getElementById('telefono');
    const email = document.getElementById('email');
    const direccion = document.getElementById('direccion');
    
    //Apoderado suplente
    const sub_names = document.getElementById('sub_names');
    const sub_lastnames = document.getElementById('sub_lastnames');
    const sub_telefono = document.getElementById('sub_telefono');
    const sub_email = document.getElementById('sub_email');
    const sub_direccion = document.getElementById('sub_direccion');
    
    function editar() {
        btneditar.hidden = true;
        cancelar.hidden = false;
        enviar.hidden = false;
        enableInput();
    }

    function cancelEditar() {
        btneditar.hidden = false;
        cancelar.hidden = true;
        enviar.hidden = true;
        disableInput();
    }

    function enableInput() {
        apellidos.disabled = false;
        nombres.disabled = false;
        run.disabled = false;
        email_institucional.disabled = false;
        nivel.disabled = false;
        prioridad.disabled = false;
        
        names.disabled = false;
        lastnames.disabled = false;
        telefono.disabled = false;
        email.disabled = false;
        direccion.disabled = false;
        
        sub_names.disabled = false;
        sub_lastnames.disabled = false;
        sub_telefono.disabled = false;
        sub_email.disabled = false;
        sub_direccion.disabled = false;
    }

    function disableInput() {
        apellidos.disabled = true;
        nombres.disabled = true;
        run.disabled = true;
        email_institucional.disabled = true;
        nivel.disabled = true;
        prioridad.disabled = true;

        names.disabled = true;
        lastnames.disabled = true;
        telefono.disabled = true;
        email.disabled = true;
        direccion.disabled = true;

        sub_names.disabled = true;
        sub_lastnames.disabled = true;
        sub_telefono.disabled = true;
        sub_email.disabled = true;
        sub_direccion.disabled = true;
    }
</script>
@endsection