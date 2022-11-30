@extends('layouts.app')
@section('content')
@php
    if(session('res')) $res = session('res');
@endphp
@if (isset($res))
    @if($res['status'] == 200)
        <div class="alert alert-success">
            {{ $res['message'] }}
        </div>
    @elseif($res['status'] == 400)
        <div class="alert alert-danger">
            {{ $res['message'] }}
        </div>
    @endif
@endif
<div class="container">
    <form method="POST" action="{{route('updateEstudiante', ['id' => $estudiante->id, 'apoderado' => $estudiante->apoderado_id])}}" class="col-md-10 mt-3 row">
        @csrf
        <h1>Estudiante</h1>
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
            <input type="text" name="run" id="run" class="form-control" value="{{$estudiante->rut}}" disabled>
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
            <select name="prioridad" id="prioridad" class="form-control"  disabled>
                <option value="1" @if($estudiante->prioridad == 1) selected @endif>No proritario</option>
                <option value="2" @if($estudiante->prioridad == 2) selected @endif>Nuevo proritario</option>
                <option value="3" @if($estudiante->prioridad == 3) selected @endif>Proritario</option>
            </select>
        </div>
        <h1>Apoderado</h1>
        @if($estudiante->apoderado)    
            <div class="form-group mb-3 col-6">
                <label for="names" class="form-label">Nombres</label>
                <input type="text" id="names" name="names" class="form-control" value="{{$estudiante->apoderado->nombres}}" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="lastnames" class="form-label">Apellidos</label>
                <input type="text" id="lastnames" name="lastnames" class="form-control" value="{{$estudiante->apoderado->apellidos}}" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" value="{{$estudiante->apoderado->telefono}}" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" value="{{$estudiante->apoderado->email}}" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="{{$estudiante->apoderado->direccion}}" disabled>
            </div>
        @else
            <div class="form-group mb-3 col-6">
                <label for="names" class="form-label">Nombres</label>
                <input type="text" id="names" name="names" class="form-control" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="lastnames" class="form-label">Apellidos</label>
                <input type="text" id="lastnames" name="lastnames" class="form-control" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control" disabled>
            </div>
            <div class="form-group mb-3 col-6">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control" disabled>
            </div>
        @endif
        <div class="buttons">
            <button type="button" id="btn-editar" class="btn btn-secondary" onclick="editar()">Editar</button>
            <button type="button" id="btn-cancelar" class="btn btn-danger" onclick="cancelEditar()" hidden>Cancelar</button>
            <button type="submit" id="btn-enviar" class="btn btn-primary" hidden>Guardar</button>
        </div>
    </form>
</div>
<script>
    const btneditar = document.getElementById('btn-editar');
    const cancelar = document.getElementById('btn-cancelar');
    const enviar = document.getElementById('btn-enviar');

    const apellidos = document.getElementById('apellidos');
    const nombres = document.getElementById('nombres');
    const run = document.getElementById('run');
    const email_institucional = document.getElementById('email_institucional');
    const nivel = document.getElementById('nivel');
    const prioridad = document.getElementById('prioridad');
    const names = document.getElementById('names');
    const lastnames = document.getElementById('lastnames');
    const telefono = document.getElementById('telefono');
    const email = document.getElementById('email');
    const direccion = document.getElementById('direccion');
    
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
    }
</script>
@endsection