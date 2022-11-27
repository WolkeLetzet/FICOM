@extends('layouts.app')
@section('content')

<div class="container">
    <form class="col-md-10 mt-3 row">
        <h1>Estudiante</h1>
        <div class="form-group mb-3 col-4">
            <label for="apellido_paterno" class="form-label">Apellidos</label>
            <input type="text" name="apellido_paterno" class="form-control" value="{{$estudiante->apellidos}}" disabled>
        </div>
        <div class="form-group mb-3 col-4">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" name="nombres" class="form-control" value="{{$estudiante->nombres}}" disabled>
        </div>
        <div class="form-group mb-3 col-4">
            <label for="run" class="form-label">RUN</label>
            <input type="text" name="run" class="form-control" value="{{$estudiante->rut}}" disabled>
        </div>
        <div class="form-group mb-3 col-4">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="text" name="email" class="form-control" value="{{$estudiante->email_institucional}}" disabled>
        </div>
        <div class="form-group mb-3 col-4">
            <label for="nivel" class="form-label">Nivel</label>
            <input type="text" name="nivel" class="form-control" value="{{$estudiante->curso->curso}}" disabled>
        </div>
        <div class="form-group mb-3 col-4">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select name="prioridad" class="form-control" disabled>
                <option value="1" @if($estudiante->prioridad == 1) selected @endif>No proritario</option>
                <option value="2" @if($estudiante->prioridad == 2) selected @endif>Nuevo proritario</option>
                <option value="3" @if($estudiante->prioridad == 3) selected @endif>Proritario</option>
            </select>
        </div>
        <h1>Apoderado</h1>
        <div class="form-group mb-3 col-6">
            <label for="fullname" class="form-label">Nombre completo</label>
            <input type="text" name="fullname" class="form-control" value="{{$estudiante->nombres . ' ' . $estudiante->apellidos}}" disabled>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{$estudiante->telefono}}" disabled>
        </div>
        <div class="form-group mb-3 col-6">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="text" name="email" class="form-control" value="{{$estudiante->email}}" disabled>
        </div>
    </form>
</div>
@endsection