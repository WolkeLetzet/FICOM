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
            <input type="text" id="apellido_paterno" name="apellido_paterno" value="{{ old('apellido_paterno') }}" class="form-control @error('apellido_paterno') is-invalid @enderror" autofocus>
                
            @error('apellido_paterno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3 col-md-3 col-6">
            <label for="apellido_materno" class="form-label">Apellido Materno</label>
            <input type="text" id="apellido_materno" name="apellido_materno" value="{{ old('apellido_materno') }}" class="form-control @error('apellido_materno') is-invalid @enderror">
                
            @error('apellido_materno')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3 col-md-6 col-6">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" id="nombres" name="nombres" value="{{ old('nombres') }}" class="form-control @error('nombres') is-invalid @enderror">
                
            @error('nombres')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="run" class="form-label">RUN</label>
            <input type="text" id="run" name="run" value="{{ old('run') }}" class="form-control @error('run') is-invalid @enderror">
                
            @error('run')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="nivel" class="form-label">Nivel</label>
            <select id="nivel" name="nivel" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                @foreach ($cursos as $curso)
                    <option value="{{$curso->id}}" @selected(old('nivel') == $curso->id)>{{$curso->curso . '-' . $curso->paralelo}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3 col-md-4 col-6">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select id="prioridad" name="prioridad" class="form-control form-select">
                <option value="" selected disabled hidden>Selecciona una opción</option>
                <option @selected(old('prioridad') == 'alumno regular') value="alumno regular">Alumno regular</option>
                <option @selected(old('prioridad') == 'nuevo prioritario') value="nuevo prioritario">Nuevo prioritario</option>
                <option @selected(old('prioridad') == 'prioritario') value="prioritario">Prioritario</option>
            </select>
        </div>
        <div class="row mt-3">
            <h2>Apoderado</h2>
            <div class="form-group mb-3 col-6">
                <label for="names" class="form-label">Nombres</label>
                <input type="text" id="names" name="names" value="{{ old('names') }}" class="form-control @error('names') is-invalid @enderror">
                
                @error('names')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos')}}" class="form-control @error('apellidos') is-invalid @enderror">
                
                @error('apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono') }}" class="form-control @error('telefono') is-invalid @enderror">
                
                @error('telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion') }}" class="form-control @error('direccion') is-invalid @enderror">
                
                @error('direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <h2>Apoderado suplente</h2>
            <div class="form-group mb-3 col-6">
                <label for="sub_names" class="form-label">Nombres</label>
                <input type="text" id="sub_names" name="sub_names" value="{{ old('sub_names') }}" class="form-control @error('sub_names') is-invalid @enderror">
                
                @error('sub_names')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="sub_apellidos" class="form-label">Apellidos</label>
                <input type="text" id="sub_apellidos" name="sub_apellidos" value="{{ old('sub_apellidos') }}" class="form-control @error('sub_apellidos') is-invalid @enderror">
                
                @error('sub_apellidos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-6">
                <label for="sub_telefono" class="form-label">Teléfono</label>
                <input type="text" id="sub_telefono" name="sub_telefono" value="{{ old('sub_telefono') }}" class="form-control @error('sub_telefono') is-invalid @enderror">
                
                @error('sub_telefono')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="sub_email" class="form-label">Correo Electrónico</label>
                <input type="email" id="sub_email" name="sub_email" value="{{ old('sub_email') }}" class="form-control @error('sub_email') is-invalid @enderror">
                
                @error('sub_email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3 col-md-6 col-12">
                <label for="sub_direccion" class="form-label">Dirección</label>
                <input type="text" id="sub_direccion" name="sub_direccion" value="{{ old('sub_direccion') }}" class="form-control @error('sub_direccion') is-invalid @enderror">
                
                @error('sub_direccion')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary my-3">Guardar</button>
        </div>
    </form>
</div>
@endsection
