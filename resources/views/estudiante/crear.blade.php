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
@if(isset($res) && $res['status'] == 400)
    @php
        $estudiante = $res['estudiante'];
    @endphp
        
    <div class="container" id="form-container">
        <form method="post" action="{{ route('crearEstudiante') }}" id="crearEstudiante" class="col-md-10 mt-3 row card">
            @csrf
            <h1 id="form-title">Estudiante</h1>
            <div class="form-group mb-3 col-md-3 col-6">
                <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
                <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{$estudiante['apellido_paterno']}}" class="form-control" autofocus>
            </div>
            <div class="form-group mb-3 col-md-3 col-6">
                <label for="apellido_materno" class="form-label">Apellido Materno</label>
                <input type="text" id="apellido_materno" name="apellido_materno" value="{{$estudiante['apellido_materno']}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-6 col-6">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" id="nombres" name="nombres" value="{{$estudiante['nombres']}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-4 col-6">
                <label for="run" class="form-label">RUN</label>
                <input type="text" id="run" name="run" value="{{$estudiante['run']}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-4 col-6">
                <label for="nivel" class="form-label">Nivel</label>
                <select id="nivel" name="nivel" class="form-control form-select">
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}" @if($estudiante['nivel'] == $curso->id) selected @endif>{{$curso->curso . '-' . $curso->paralelo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 col-md-4 col-6">
                <label for="prioridad" class="form-label">Prioridad</label>
                <select id="prioridad" name="prioridad" class="form-control form-select">
                    <option value="Sin Beneficios" @if($estudiante['prioridad'] == 'Sin Beneficios') selected @endif>Sin Beneficios</option>
                    <option value="Nuevo Prioritario" @if($estudiante['prioridad'] == 'Nuevo Prioritario') selected @endif>Nuevo Prioritario</option>
                    <option value="Prioritario" @if($estudiante['prioridad'] == 'Prioritario') selected @endif>Proritario</option>
                </select>
            </div>
            <div class="row mt-3">
                <h1>Apoderado</h1>
                <div class="form-group mb-3 col-6">
                    <label for="fullname" class="form-label">Nombres</label>
                    <input type="text" id="names" name="names" value="{{$estudiante['names']}}" class="form-control">
                </div>
                <div class="form-group mb-3 col-6">
                    <label for="fullname" class="form-label">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="{{$estudiante['apellidos']}}" class="form-control">
                </div>
                <div class="form-group mb-3 col-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" value="{{$estudiante['telefono']}}" class="form-control">
                </div>
                <div class="form-group mb-3 col-md-6 col-12">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" id="email" name="email" value="{{$estudiante['email']}}" class="form-control">
                </div>
                <div class="form-group mb-3 col-md-6 col-12">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" id="direccion" name="direccion" value="{{$estudiante['direccion']}}" class="form-control">
                </div>
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@else
<div class="container card" id="form-container">
    <form method="post" action="{{ route('crearEstudiante') }}" id="crearEstudiante" class="mt-3 row">
        @csrf
        <h1 id="form-title">Estudiante</h1>
        <div class="form-group mb-3 col-md-3 col-6">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" required autofocus>
        </div>
        <div class="form-group mb-3 col-md-3 col-6">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" class="form-control" required>
        </div>
        <div class="form-group mb-3 col-md-6 col-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" class="form-control" required>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="run" class="form-label">RUN</label>
            <input type="text" id="run" name="run" class="form-control" required>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="nivel" class="form-label">Nivel</label>
            <select id="nivel" name="nivel" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}">{{$curso->curso . '-' . $curso->paralelo}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select id="prioridad" name="prioridad" class="form-control form-select" required>
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option value="Sin Beneficios">Sin Beneficios</option>
                <option value="Nuevo Prioritario">Nuevo Prioritario</option>
                <option value="Prioritario">Proritario</option>
            </select>
        </div>
        <div class="row mt-3">
            <h1>Apoderado</h1>
            <div class="form-group mb-3 col-4">
                <label for="fullname" class="form-label">Nombres</label>
                <input type="text" id="names" name="names" class="form-control">
            </div>
            <div class="form-group mb-3 col-4">
                <label for="fullname" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" class="form-control">
            </div>
            <div class="form-group mb-3 col-4">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-5 col-12">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-7 col-12">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>

@endif

<style lang="scss">
    button{
        margin: 2rem 0 2rem 0 ;
    }
</style>
@endsection
