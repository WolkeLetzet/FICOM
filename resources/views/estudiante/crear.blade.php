@extends('layouts.app')
@section('content')

@php
    if(isset($res) && $res['status'] == 400) $estudiante = $res['estudiante'];
@endphp
        
<div class="container card form-container">
    <form method="post" action="{{ route('estudiante.store') }}" id="estudiante.store" class="mt-3 row">
        @csrf
        <h2 class="form-title">Estudiante</h2>
        <div class="form-group mb-3 col-md-3 col-6">
            <label for="apellido_paterno" class="form-label">Apellido Paterno</label>
            <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{isset($estudiante) ? $estudiante['apellido_paterno'] : ''}}" class="form-control" autofocus>
        </div>
        <div class="form-group mb-3 col-md-3 col-6">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" value="{{isset($estudiante) ? $estudiante['apellido_materno'] : ''}}" class="form-control">
        </div>
        <div class="form-group mb-3 col-md-6 col-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" value="{{isset($estudiante) ? $estudiante['nombres'] : ''}}" class="form-control">
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="run" class="form-label">RUN</label>
            <input type="text" id="run" name="run" value="{{isset($estudiante) ? $estudiante['run'] : ''}}" class="form-control">
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="nivel" class="form-label">Nivel</label>
            <select id="nivel" name="nivel" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                @if(isset($estudiante))
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}" @if($estudiante['nivel'] == $curso->id) selected @endif>{{$curso->curso . '-' . $curso->paralelo}}</option>
                    @endforeach
                @else
                    @foreach ($cursos as $curso)
                        <option value="{{$curso->id}}">{{$curso->curso . '-' . $curso->paralelo}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select id="prioridad" name="prioridad" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                @if(isset($estudiante))
                    <option value="alumno regular" @if($estudiante['prioridad'] == 'alumno regular') selected @endif>Alumno regular</option>
                    <option value="nuevo prioritario" @if($estudiante['prioridad'] == 'nuevo prioritario') selected @endif>nuevo prioritario</option>
                    <option value="prioritario" @if($estudiante['prioridad'] == 'prioritario') selected @endif>Proritario</option>
                @else
                    <option value="alumno regular">Alumno regular</option>
                    <option value="nuevo prioritario">Nuevo prioritario</option>
                    <option value="prioritario">Prioritario</option>
                @endif
            </select>
        </div>
        <div class="row mt-3">
            <h2>Apoderado</h2>
            <div class="form-group mb-3 col-6">
                <label for="names" class="form-label">Nombres</label>
                <input type="text" id="names" name="names" value="{{isset($estudiante) ? $estudiante['names'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" value="{{isset($estudiante) ? $estudiante['apellidos'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{isset($estudiante) ? $estudiante['telefono'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{isset($estudiante) ? $estudiante['email'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{isset($estudiante) ? $estudiante['direccion'] : ''}}" class="form-control">
            </div>
        </div>
        <div class="row mt-3">
            <h2>Apoderado suplente</h2>
            <div class="form-group mb-3 col-6">
                <label for="sub_names" class="form-label">Nombres</label>
                <input type="text" id="sub_names" name="sub_names" value="{{isset($estudiante) ? $estudiante['sub_names'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="sub_apellidos" class="form-label">Apellidos</label>
                <input type="text" id="sub_apellidos" name="sub_apellidos" value="{{isset($estudiante) ? $estudiante['sub_apellidos'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-6">
                <label for="sub_telefono" class="form-label">Teléfono</label>
                <input type="text" id="sub_telefono" name="sub_telefono" value="{{isset($estudiante) ? $estudiante['sub_telefono'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="sub_email" class="form-label">Correo Electrónico</label>
                <input type="email" id="sub_email" name="sub_email" value="{{isset($estudiante) ? $estudiante['sub_email'] : ''}}" class="form-control">
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="sub_direccion" class="form-label">Dirección</label>
                <input type="text" id="sub_direccion" name="sub_direccion" value="{{isset($estudiante) ? $estudiante['sub_direccion'] : ''}}" class="form-control">
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary my-3">Guardar</button>
        </div>
    </form>
</div>
@endsection
