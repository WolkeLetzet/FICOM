@extends('layouts.app')
@section('content')
@php if(session('res') && session('res')['status'] == 400) $beca = session('res')['beca']; @endphp
<div class="container card form-container">
    <form method="post" action="{{ route('crearBeca') }}" id="formBeca" class="mt-3 row">
        @csrf
        <h2 class="form-title">Beca</h2>
        
        <div class="form-group mb-3 col-6">
            <label class="form-label" for="nombre">Nombre</label>
            <input class="form-control" type="text" name="nombre" value="{{isset($beca) ? $beca['nombre'] : ''}}">
        </div>

        <div class="form-group mb-3 col-6">
            <label class="form-label" for="descuento">% Descuento</label>
            <input class="form-control" type="number" name="descuento" value="{{isset($beca) ? $beca['descuento'] : ''}}" min="0" max="100">
        </div>

        <div class="form-group mb-3 col-12">
            <label class="form-label" for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion">{{isset($beca) ? $beca['descripcion'] : ''}}</textarea>
        </div>

        <div>
            <button type="submit" class="btn btn-primary my-3">Guardar</button>
        </div>
    </form>
@endsection